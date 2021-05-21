<?php
class User_Model extends Model {
    public function __construct() {
    
    }

    public function signup($surname, $name, $patronymic, $email, $phone, $password) {
        $mysqli = $this->db_connect();
        
        $password = md5(md5(MD5_SALT.$password).MD5_SALT);

        $query = "INSERT INTO `users` VALUES (NULL, '1', '$password', '$email', '$phone', '$surname', '$name', " . $patronymic === null ? 'NULL' : "'$patronymic'" . ")";
        if (!$mysqli->query($query)) {
            $mysqli->close();
            return DB_ERROR;
        }

        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
    }
}