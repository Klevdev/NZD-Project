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
            return DB_ERROR;
        }

        $query = "SELECT `id`, `train_types`.`name`, ";
    }
}