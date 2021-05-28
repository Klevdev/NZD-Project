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
			if ($check !== true) $errors[$key] = $check;
		}
		return $errors;
	}

	private function validate_callback_time($value) {
		if (empty($value)) return 'Пожалуйста, заполните это поле';
		if (mb_strlen($value) > 5) return 'Укажите время без секунд в 24-часовом формате';
		if (!preg_match("/^[012][0-9]:[0-5][0-9]$/", $value)) return 'Некорректный формат времени';
		return true; 
	}

	private function validate_name($value) {
		if (empty($value)) return 'Пожалуйста, заполните это поле';
		if (mb_strlen($value) > 30) return 'Поле не должно быть больше 30 символов';
		if (preg_match("/[0-9\\\+\?\|\/{\}\]\[;:@\$\%!\^&\*\(\)=_\,\.~`]/", $value)) return 'Поле может содержать только буквы и дефис';
		return true;
	}
	
	private function validate_surname($value) {
		if (empty($value)) return 'Пожалуйста, заполните это поле';
		if (mb_strlen($value) > 30) return 'Поле не должно быть больше 30 символов';
		if (preg_match("/[0-9\\\+\?\|\/{\}\]\[;:@\$\%!\^&\*\(\)=_\,\.~`]/", $value)) return 'Поле может содержать только буквы и дефис';
		return true;
	}
	
	private function validate_patronymic($value) {
		if (mb_strlen($value) > 30) return 'Поле не должно быть больше 30 символов';
		if (preg_match("/[0-9\\\+\?\|\/{\}\]\[;:@\$\%!\^&\*\(\)=_\,\.~`]/", $value)) return 'Поле может содержать только буквы и дефис';
		return true;
	}
	
	private function validate_email($value) {
		if (empty($value)) return 'Пожалуйста, заполните это поле';
		if (mb_strlen($value) > 40) return 'Поле не должно быть больше 40 символов';
		if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $value)) return 'Некорректный E-mail';
		return true;
	}
	
	private function validate_phone($value) {
		if (empty($value)) return 'Пожалуйста, заполните это поле';
		if (mb_strlen($value) > 13) return 'Поле не должно быть больше 13 символов';
		if (!preg_match("/^[\+7|8]+\d{10}$/", $value)) return 'Некорректный номер';
		return true;
	}
	
	private function validate_password($value) {
		if (empty($value)) return 'Пожалуйста, заполните это поле';
		if (mb_strlen($value) < 8) return 'Поле не должно быть меньше 8 символов';
		if (mb_strlen($value) > 20) return 'Поле не должно быть больше 20 символов';
		return true;
	}

	private function validate_req_callback($value) {
		return true;
	}

    private function validate_text($value) {
		if (empty($value)) return 'Пожалуйста заполните это поле';
		if (strlen($value) > 250) return 'Сообщение не должно быть больше 250 символов';
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