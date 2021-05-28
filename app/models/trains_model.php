<?php
class Trains_Model extends Model {
    public function __construct() {

    }

    public function get_trains()
    {
        $mysqli = $this->db_connect();
        if ($mysqli === 0) {
            return DB_ERROR;
        }

        $query = 'SELECT `trains`.`id`, `train_types`.`name`, `train_types`.`id` AS `type_id` FROM `train_types`, `trains` WHERE `trains`.`id_train_type` = `train_types`.`id`' . (!empty($_GET['type_train']) ? ' AND `train_types`.`id` = ' . $_GET['type_train'] : '') . ' ORDER BY `id` DESC';
        $result = $mysqli->query($query);

        if ($result->num_rows <= 0)
            return false;

        while ($row = $result->fetch_assoc())
        {
            $rating = $mysqli->query('SELECT COUNT(*) AS `count`, SUM(rating) AS `sum` FROM `train_comments` WHERE `id_train` = ' . $row['id'])->fetch_assoc();

            if ($rating['count'] > 0)
                $row['rating'] = round(($rating['sum'] / $rating['count']), 1);
            else
                $row['rating'] = 0;

            $data['trains'][] = $row;
        }

        return $data;
    }

    public function get_comments()
    {
        $mysqli = $this->db_connect();
        if ($mysqli === 0) {
            return DB_ERROR;
        }

        $query = 'SELECT `trains`.`id`, `train_types`.`name`, `train_types`.`id` AS `type_id` FROM `train_types`, `trains` WHERE `trains`.`id_train_type` = `train_types`.`id` AND `trains`.`id` = ' . $_GET['id'];
        $result = $mysqli->query($query);

        if ($result->num_rows <= 0)
            return false;
        else
            $data['train_info'] = $result->fetch_assoc();

        $query = 'SELECT `users`.`name`, `users`.`surname`, `train_comments`.`rating`, `train_comments`.`text`, `train_comments`.`date` FROM `users`, `train_comments` WHERE `users`.`id` = `train_comments`.`id_user` AND `train_comments`.`id_train` = ' . $_GET['id'] . ' ORDER BY `date` DESC';
        $result = $mysqli->query($query);

        if ($result->num_rows > 0)
            while ($row = $result->fetch_assoc())
                $data['comments'][] = $row;
        else
            $data['count'] = false;

        return $data;
    }

    public function add_comment($id_train, $rating, $comment) {
        if (!empty($rating) && !empty(trim($comment)))
        {
            $mysqli = $this->db_connect();
            if ($mysqli === 0) {
                return DB_ERROR;
            }

            $mysqli->query('INSERT INTO `train_comments` VALUES (NULL, ' . $_SESSION['user']['id'] . ', ' . $id_train . ', ' . $rating . ', "' . $comment . '", "' . date('Y-m-d') . '")');

            return true;
        }
        else
            echo false;
    }
}