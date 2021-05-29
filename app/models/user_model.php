<?php
class User_Model extends Model {
    public function signup($surname, $name, $patronymic, $email, $phone, $password) {
        $mysqli = $this->db_connect();
        if ($mysqli === 0) {
            return DB_ERROR;
        }
        
        $password = md5(md5(MD5_SALT.$password).MD5_SALT);

        $query = "INSERT INTO `users` VALUES (NULL, '1', '$password', '$email', '$phone', '$surname', '$name', " . ($patronymic === null ? 'NULL' : "'$patronymic'") . ")";

        if (!$mysqli->query($query)) {
            echo "<br>$query";
            $mysqli->close();
            return DB_ERROR;
        }

        $id = $mysqli->insert_id;
        $mysqli->close();
        return [
            'id' => $id,
            'display_name' => mb_strtoupper(mb_substr($name, 0, 1)).'. '.$surname,
            'role' => 1
        ];
    }

    public function login($email, $password) {
        $mysqli = $this->db_connect();
        if ($mysqli === 0) {
            return DB_ERROR;
        }
        $password = md5(md5(MD5_SALT.$password).MD5_SALT);

        $query = "SELECT `id`, `name`, `surname`, `role` FROM `users` WHERE `email` = '$email' AND `password` = '$password';";

        $result = $mysqli->query($query);

        if (!$result) {
            echo "<br>$query";
            $mysqli->close();
            return DB_ERROR;
        }
        
        if ($result->num_rows === 0) {
            echo "No user found<br>$query";
            $mysqli->close();
            return false;
        }
        $result = $result->fetch_assoc();
        return  [
            'id' => $result['id'],
            'display_name' => mb_strtoupper(mb_substr($result['name'], 0, 1)).'. '.$result['surname'],
            'role' => $result['role']
        ];
    }

    public function get_orders() {
        $mysqli = $this->db_connect();
        if ($mysqli === 0) {
            return DB_ERROR;
        }

        $query = 'SELECT `orders`.`id`, `routes`.`name`, `trips`.`start_time` FROM `orders`, `routes`, `trips` WHERE `orders`.`id_trip` = `trips`.`id` AND `trips`.`id_route` = `routes`.`id` AND `orders`.`email` = (SELECT `email` FROM `users` WHERE `id` = ' . $_SESSION['user']['id'] . ')';
        $result = $mysqli->query($query);

        if ($result->num_rows > 0)
            while ($row = $result->fetch_assoc())
                $data['orders'][] = $row;
        else
            $data['count'] = false;

        return $data;
    }

    public function get_seats() {
        $mysqli = $this->db_connect();
        if ($mysqli === 0) {
            return DB_ERROR;
        }

        $query = 'SELECT `routes`.`name`, `orders`.`id` FROM `orders`, `trips`, `routes` WHERE `orders`.`id_trip` = `trips`.`id` AND `trips`.`id_route` = `routes`.`id` AND `orders`.`email` = (SELECT `email` FROM `users` WHERE `id` = ' . $_SESSION['user']['id'] . ') AND `orders`.`id` = ' . $_GET['id'];
        $result = $mysqli->query($query);

        if($result->num_rows <= 0)
            return false;
        else
            $data['order_info'] = $result->fetch_assoc();

        $query = 'SELECT `orders_and_seats`.`id_carriage`, `orders_and_seats`.`seat_num`, `carriage_types`.`name` FROM `orders_and_seats`, `carriages`, `carriage_types` WHERE `carriages`.`id_carriage_type` = `carriage_types`.`id` AND `orders_and_seats`.`id_carriage` = `carriages`.`id` AND `orders_and_seats`.`id_order` = ' . $_GET['id'];
        $result = $mysqli->query($query);

        while ($row = $result->fetch_assoc())
            $data['seats'][] = $row;

        return $data;
    }
}