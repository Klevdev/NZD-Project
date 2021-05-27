<?php
class Feedback_Model extends Model {
    public function send_message() {
        $mysqli = $this->db_connect();
        if ($mysqli === 0) {
            return DB_ERROR.'-0';
        }
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $req_callback = $_POST['req_callback'] ? '1' : '0';
        $text = $_POST['text'];
        $callback_time = (isset($_POST['callback_time'])) ? "'".$_POST['callback_time']."'" : 'NULL';

        $query = "INSERT INTO `messages` VALUES (NULL, '$name', '$phone', '$email', '$req_callback', '0', '$text', $callback_time)";
        $result = $mysqli->query($query);
        if (!$result) {
            echo "<br>$query";
            $mysqli->close();
            return DB_ERROR.'-1';
        }
        
        $mysqli->close();
        return true;
    }
}