<?php
class Administrative_Model extends Model {
    public function __construct() {
    }

    public function check_privelege($user_id) {
        $mysqli = $this->db_connect();
        if ($mysqli === 0) {
            return DB_ERROR;
        }
    
        $query = "SELECT `role` FROM `users` WHERE `id` = '$user_id'";
        $result = $mysqli->query($query);
        if (!$result) {
            echo "<br>$query";
            $mysqli->close();
            return DB_ERROR;
        }
        if ($result->num_rows === 0) {
            // echo "No user found<br>$query";
            $mysqli->close();
            return false;
        }
        
        $result = $result->fetch_assoc()['role'];
        if ($result == '1') {
            $mysqli->close();
            return false;
        }
        if ($result == '2') {
            $mysqli->close();
            return true;
        }
    }
    
    public function get_trips($page) {
        $mysqli = $this->db_connect();
        if ($mysqli === 0) {
            return DB_ERROR.'-0';
        }
        $query = "SELECT `trips`.`id` AS `id`, `id_route` AS `route_id`, `routes`.`name` AS `route_name`, `id_train` AS `train_id`, `start_time` 
            FROM `trips` JOIN `routes` ON (`trips`.`id_route` = `routes`.`id`) 
            LIMIT ". ELEMENTS_PER_PAGE * ($page-1) .", " . ELEMENTS_PER_PAGE;
        $result = $mysqli->query($query);
        if (!$result) {
            $mysqli->close();
            echo $query;
            return DB_ERROR.'-1';
        }
        
        $trips = $result->fetch_all(MYSQLI_ASSOC);
        if ($trips === null) {
            $mysqli->close();
            return [];
        }
        
        $mysqli->close();
        return $trips;
    }

    public function get_routes($page) {
        $mysqli = $this->db_connect();
        if ($mysqli === 0) {
            return DB_ERROR.'-0';
        }
        $query = "SELECT `id`, `name`, `is_active` FROM `routes` LIMIT ". ELEMENTS_PER_PAGE * ($page-1) .", " . ELEMENTS_PER_PAGE;
        $result = $mysqli->query($query);
        if (!$result) {
            $mysqli->close();
            echo $query;
            return DB_ERROR.'-1';
        }
        
        $routes = $result->fetch_all(MYSQLI_ASSOC);
        if ($routes === null) {
            $mysqli->close();
            return [];
        }
        
        foreach ($routes as $route_key => $route) {
            $query = "SELECT `id_station` AS `id`, `stop_duration`, `stop_index` FROM `routes_and_stations` 
            WHERE `id_route` = '{$route['id']}'";
            
            $result = $mysqli->query($query);
            if (!$result || !$result->num_rows) {
                echo $query;
                $mysqli->close();
                return DB_ERROR.'-2';
            }
            $routes[$route_key]['time'] = 0;
            while ($station = $result->fetch_assoc()) {
                $query = "SELECT * FROM `stations` WHERE `id` = '{$station['id']}'";
                $station_result = $mysqli->query($query);
                if (!$station_result || !$station_result->num_rows) {
                    echo $query;
                    $mysqli->close();
                    return DB_ERROR.'-3';
                }
                $station_result = $station_result->fetch_assoc();
                $routes[$route_key]['stations'][(int)$station['stop_index']] = [
                    'id' => $station['id'],
                    'name' => ($station_result['city']) ? $station_result['city']."(".$station_result['name'].")" : $station_result['name'],
                    'stop_duration' => (int) $station['stop_duration']
                ];
                $routes[$route_key]['time'] += (int) $station['stop_duration'];
            }
            $routes[$route_key]['length'] = $this->get_route_length($routes[$route_key]['stations']);
            // $routes[$route_key]['time'] += $this->get_route_time($route['id']);
        }
        
        $mysqli->close();
        return $routes;
    }

    private function get_route_length($stations) {
        $length = 0;
        $mysqli = $this->db_connect();
        if ($mysqli === 0) {
            return DB_ERROR.'-0';
        }
        for ($i = 1; $i <= count($stations) - 1; $i++) {
            $query = "SELECT `distance` FROM `station_joins` WHERE `id_station_start` = '{$stations[$i]['id']}' AND  `id_station_end` = '{$stations[$i+1]['id']}'";
            $result = $mysqli->query($query);
            if (!$result || !$result->num_rows) {
                echo $query;
                $mysqli->close();
                return DB_ERROR.'-1';
            }
            $length += (int) $result->fetch_row()[0];
        }
        $mysqli->close();
        return $length;
    }
    
    public function get_routes_list() {
        $mysqli = $this->db_connect();
        if ($mysqli === 0) {
            return DB_ERROR.'-0';
        }
        $query = "SELECT `id`, `name` FROM `routes`";
        $result = $mysqli->query($query);
        if (!$result) {
            $mysqli->close();
            return DB_ERROR.'-1';
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function get_trains_list() {
        $mysqli = $this->db_connect();
        if ($mysqli === 0) {
            return DB_ERROR.'-0';
        }
        $query = "SELECT `trains`.`id` AS `id`, `train_types`.`name` AS `name` FROM `trains` JOIN `train_types` ON (`trains`.`id_train_type` = `train_types`.`id`)";
        $result = $mysqli->query($query);
        if (!$result) {
            echo $query;
            $mysqli->close();
            return DB_ERROR.'-1';
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function add_trip($id_route, $id_train, $start_time) {
        $mysqli = $this->db_connect();
        if ($mysqli === 0) {
            return DB_ERROR.'-0';
        }
        
        $query = "INSERT INTO `trips` VALUES (NULL, '$id_route', '$id_train', '$start_time')";
        $result = $mysqli->query($query);    
        if (!$result) {
            $mysqli->close();
            return DB_ERROR.'-1';
        }
        return true;
    }
    
    public function edit_trip($id_trip, $id_route, $id_train, $start_time) {
        $mysqli = $this->db_connect();
        if ($mysqli === 0) {
            return DB_ERROR.'-0';
        }
        
        $query = "UPDATE `trips` SET `id_route` = '$id_route', `id_train` = '$id_train', `start_time` = '$start_time' WHERE `id` = '$id_trip'";
        $result = $mysqli->query($query);    
        if (!$result) {
            echo $query;
            $mysqli->close();
            return DB_ERROR.'-1';
        }
        return true;
    }

    public function delete_trip($id_trip) {
        $mysqli = $this->db_connect();
        if ($mysqli === 0) {
            return DB_ERROR.'-0';
        }
        
        $query = "DELETE FROM `trips`  WHERE `id` = '$id_trip'";
        $result = $mysqli->query($query);    
        if (!$result) {
            echo $query;
            $mysqli->close();
            return DB_ERROR.'-1';
        }
        return true;
    }

    // private function get_route_time($id_route, $id_train) {
    //     $time = 0;
    //     $mysqli = $this->db_connect();
    //     if ($mysqli === 0) {
    //         return DB_ERROR.'-0';
    //     }
    //     for ($i = 0; $i < count($stations) - 1; $i++) {
    //         $query = "SELECT `distance` FROM `station_joins` WHERE `id_station_start` = '{$stations[$i]}' AND  `id_station_end` = '{$stations[$i+1]}'";
    //         $result = $mysqli->query($query);
    //         if (!$result || !$result->num_rows) {
    //             echo $query;
    //             $mysqli->close();
    //             return DB_ERROR.'-1';
    //         }
    //         $length += (int) $result->fetch_row()[0];
    //     }
    //     $mysqli->close();
    //     return $length;
    // }

    public function get_trains($page) {
        
        $mysqli = $this->db_connect();
        if ($mysqli === 0) {
            return DB_ERROR.'-0';
        }
        $query = "SELECT `trains`.`id`, `train_types`.`name` 
            FROM `trains` JOIN `train_types` ON (`trains`.`id_train_type` = `train_types`.`id`) 
            LIMIT ". ELEMENTS_PER_PAGE * ($page-1) .", " . ELEMENTS_PER_PAGE;
        $result = $mysqli->query($query);
        if (!$result) {
            $mysqli->close();
            echo $query;
            return DB_ERROR.'-1';
        }
        
        $trains = $result->fetch_all(MYSQLI_ASSOC);
        if ($trains === null) {
            $mysqli->close();
            return [];
        }
        
        $query = "SELECT `id`, `name` FROM `carriage_types`";
        $result = $mysqli->query($query);
        if (!$result) {
            echo $query;
            $mysqli->close();
            return DB_ERROR.'-2';
        }
        $carriages_types = $result->fetch_all(MYSQLI_ASSOC);

        foreach ($trains as $key => $train) {
            foreach ($carriages_types as $type) {
                $query = "SELECT COUNT(`id_carriage`) 
                FROM `trains_and_carriages` JOIN `carriages` ON (`trains_and_carriages`.`id_carriage` = `carriages`.`id`) 
                WHERE `id_train` = '{$train['id']}' AND `id_carriage_type` = '{$type['id']}'";
                
                $result = $mysqli->query($query);
                if (!$result) {
                    echo $query;
                    $mysqli->close();
                    return DB_ERROR.'-3';
                }
                $trains[$key]['carriages'][$type['name']] = (int) $result->fetch_row()[0];
            }
        }
        $mysqli->close();
        return $trains;
    }

    public function add_train($train_type, $carriages) {
        $mysqli = $this->db_connect();
        if ($mysqli === 0) {
            return DB_ERROR.'-0';
        }
        $carriages_ids = [];
        foreach($carriages as $type => $count) {
            for ($i = 0; $i < $count; $i++) {
                $query = "INSERT INTO `carriages` VALUES (NULL, '$type')";
                $result = $mysqli->query($query);    
                if (!$result) {
                    $mysqli->close();
                    return DB_ERROR.'-1';
                }
                $carriages_ids[] = $mysqli->insert_id;
            }
        }
        $query = "INSERT INTO `trains` VALUES (NULL, '$train_type', '1')";
        $result = $mysqli->query($query);    
        if (!$result) {
            $mysqli->close();
            return DB_ERROR.'-2';
        }
        $train_id = $mysqli->insert_id;
        
        foreach($carriages_ids as $carriage_id) {
            $query = "INSERT INTO `trains_and_carriages` VALUES ('$train_id', '$carriage_id')";
            $result = $mysqli->query($query);    
            if (!$result) {
                $mysqli->close();
                return DB_ERROR.'-3';
            }
        }
        $mysqli->close();
        return true;
    }
    
    public function delete_train($train_id) {
        $mysqli = $this->db_connect();
        if ($mysqli === 0) {
            return DB_ERROR.'-0';
        }
        $query = "SELECT `id_carriage` FROM `trains_and_carriages` WHERE `id_train` = '$train_id'";
        $result = $mysqli->query($query);    
        if (!$result || !$result->num_rows) {
            echo $query;
            $mysqli->close();
            return DB_ERROR.'-1';
        }
        $carriages_ids = $result->fetch_array(MYSQLI_NUM);

        $query = "DELETE FROM `trains_and_carriages` WHERE  `id_train` = '$train_id'";
        $result = $mysqli->query($query);    
        if (!$result) {
            echo $query;
            $mysqli->close();
            return DB_ERROR.'-4';
        }

        foreach ($carriages_ids as $id) {
            $query = "DELETE FROM `carriages` WHERE  `id` = '$id'";
            $result = $mysqli->query($query);    
            if (!$result) {
                echo $query;
                $mysqli->close();
                return DB_ERROR.'-2';
            }
        }

        $query = "DELETE FROM `trains` WHERE  `id` = '$train_id'";
        $result = $mysqli->query($query);    
        if (!$result) {
            echo $query;
            $mysqli->close();
            return DB_ERROR.'-3';
        }
                
        $mysqli->close();
        return true;
    }

    public function get_messages($page) {
        $mysqli = $this->db_connect();
        if ($mysqli === 0) {
            return DB_ERROR.'-0';
        }
        $query = "SELECT `messages`.`id`, `messages`.`name`, `email`, `phone`, `callback_time`, `text`, `message_states`.`name` AS `state` 
            FROM `messages` JOIN `message_states` ON (`messages`.`state` = `message_states`.`id`) 
            LIMIT ". ELEMENTS_PER_PAGE * ($page-1) .", " . ELEMENTS_PER_PAGE;
        $result = $mysqli->query($query);
        if (!$result) {
            $mysqli->close();
            echo $query;
            return DB_ERROR.'-1';
        }
        $messages = $result->fetch_all(MYSQLI_ASSOC);
        $mysqli->close();

        return $messages;
    }

    public function change_message_state($id, $state) {
        $mysqli = $this->db_connect();
        if ($mysqli === 0) {
            return DB_ERROR.'-0';
        }

        $query = "UPDATE `messages` SET `state` = '$state' WHERE `id` = '$id'";
        $result = $mysqli->query($query);
        if (!$result) {
            $mysqli->close();
            echo $query;
            return DB_ERROR.'-1';
        }
        $mysqli->close();
        return true;
    }

    public function delete_message($id) {
        $mysqli = $this->db_connect();
        if ($mysqli === 0) {
            return DB_ERROR.'-0';
        }
        
        $query = "DELETE FROM `messages` WHERE  `id` = '$id'";
        $result = $mysqli->query($query);    
        if (!$result) {
            echo $query;
            $mysqli->close();
            return DB_ERROR.'-1';
        }
        
        $mysqli->close();
        return true;
    }
}