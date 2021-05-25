<?php
class Validate_Model extends Model {
    public function validate_data($data) {
		$errors = [];
		foreach ($data as $key => $value) {
			$validation_function = "validate_".$key;
			$check = true;
			try {
				$check = $this->$validation_function($value);
			} catch (Exception $e) {
				echo "<br>Unexpected field name<br>".$e->getMessage();
			}
			if (!$check) $errors[$key] = $check;
		}
		return $errors;
	}

	private function validate_name($value) {
		return true;
	}
	
	private function validate_surname($value) {
		return true;
	}
	
	private function validate_patronymic($value) {
		return true;
	}
	
	private function validate_email($value) {
		return true;
	}
	
	private function validate_phone($value) {
		return true;
	}
	
	private function validate_password($value) {
		return true;
	}

	private function validate_req_callback($value) {
		return true;
	}
	
    private function validate_text($value) {
		return true;
	}

    // public function validate_data($data, $remove_empty_values=false) {
	// 	$result = [];
	// 	$mysqli = $this->db_connect();
	// 	if ($mysqli === 0) {
	// 		return false;
	// 	}
	// 	foreach ($data as $key => $value) {
	// 		if ($remove_empty_values && empty($value)) continue;
			
	// 		$key = htmlspecialchars($key);
	// 		$key = $mysqli->real_escape_string($key);
			
	// 		if (is_array($value)) {
	// 			foreach ($value as $sub_key => $sub_value) {
	// 				$value[$sub_key] = htmlspecialchars($sub_value);
	// 				$value[$sub_key] = $mysqli->real_escape_string($sub_value);
	// 			}
	// 		} else {
	// 			$value = htmlspecialchars($value);
	// 			$value = $mysqli->real_escape_string($value);
	// 		}
	// 		$result[$key] = $value;
	// 	}
	// 	$mysqli->close();
	// 	if (0) {
	// 		return false;
	// 	} else {
	// 		return $result;
	// 	}
	// }
}