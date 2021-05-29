<?php
class Search_Trips_Model extends Model {
    public function suggest_stations($str) {
        $mysqli = $this->db_connect();
        if ($mysqli === 0) {
            return DB_ERROR.'-0';
        }
        $query = "SELECT * FROM `stations` WHERE `name` LIKE '%$str%' OR `city` LIKE '%$str%'";
        $result = $mysqli->query($query);
        if (!$result) {
            $mysqli->close();
            return DB_ERROR.'-1';
        }
        if ($result->num_rows == 0) return '0';
        $stations = [];
        while ($station = $result->fetch_assoc()) {
            if (!empty($station['city'])) {
                $station['name'] = $station['city'].' ('.$station['name'].')';
            }
            $stations[] = $station;
        }
        return $stations;
    }
}