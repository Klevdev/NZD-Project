<?php
class Model {

	public function db_connect() {
		$connection = new mysqli(DB_CREDS['host'], DB_CREDS['user'], DB_CREDS['pass'], DB_CREDS['base']);
		if ($connection->connect_errno !== 0) {
			echo "Ошибка подключения к базе данных: $connection->connect_errno";
			return 0;
		}
		return $connection;
	}

	public function save_to_session($keys_values) {
		session_start();
		foreach ($keys_values as $key => $value) {
			$_SESSION[$key] = $value;
		}
		session_write_close();
	}

	public function remove_from_session($field) {
		session_start();
		unset($_SESSION[$field]);
		session_write_close();
	}

	public function count_table_rows($table_name) {
		$mysqli = $this->db_connect();
        if ($mysqli === 0) {
            return DB_ERROR;
        }
		$query = "SELECT COUNT(*) FROM `$table_name`";
		$result = $mysqli->query($query);
		if (!$result) {
			$mysqli->close();
			return DB_ERROR;
		}
		return (int) $result->fetch_row()[0];
	}
}
