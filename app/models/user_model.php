<?php
class User_Model extends Model {
    public function __construct() {
    
    }

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
            'display_name' => strtoupper(substr($name, 0, 1)).'. '.$surname,
        ];
    }

    public function login($email, $password) {
        $mysqli = $this->db_connect();
        if ($mysqli === 0) {
            return DB_ERROR;
        }
        $password = md5(md5(MD5_SALT.$password).MD5_SALT);

        $query = "SELECT `id`, `name`, `surname` FROM `users` WHERE `email` = '$email' AND `password` = '$password';";

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
            'display_name' => strtoupper(substr($result['name'], 0, 1)).'. '.$result['surname'],
        ];
    }
}