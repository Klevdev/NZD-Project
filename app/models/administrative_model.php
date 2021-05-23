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

    public function getTrains($page) {
        
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
            $mysqli->close();
            return DB_ERROR.'-2';
        }
        $carriages_types = $result->fetch_all(MYSQLI_ASSOC);

        foreach ($trains as $key => $train) {
            foreach ($carriages_types as $type) {
                $query = "SELECT COUNT(`id_carriage`) 
                FROM `trains_and_carriages` JOIN `carriages` ON (`trains_and_carriages`.`id_carriage` = `carriages`.`id_carriage_type`) 
                WHERE `id_train` = '{$train['id']}' AND `id_carriage_type` = '{$type['id']}'";
                
                $result = $mysqli->query($query);
                if (!$result) {
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
}