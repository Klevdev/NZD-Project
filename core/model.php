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

	public function validate_data($data, $remove_empty_values=false) {
		$result = [];
		$mysqli = $this->db_connect();
		if ($mysqli === 0) {
			return false;
		}
		foreach ($data as $key => $value) {
			if ($remove_empty_values && empty($value)) continue;
			
			$key = htmlspecialchars($key);
			$key = $mysqli->real_escape_string($key);
			
			if (is_array($value)) {
				foreach ($value as $sub_key => $sub_value) {
					$value[$sub_key] = htmlspecialchars($sub_value);
					$value[$sub_key] = $mysqli->real_escape_string($sub_value);
				}
			} else {
				$value = htmlspecialchars($value);
				$value = $mysqli->real_escape_string($value);
			}
			$result[$key] = $value;
		}
		$mysqli->close();
		if (0) {
			return false;
		} else {
			return $result;
		}
	}

	public function save_file() {
		
	}
}
