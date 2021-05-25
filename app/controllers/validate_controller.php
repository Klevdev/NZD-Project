<?php
class Validate_Controller extends Controller {
    public function __construct() {
        $this->model = new Validate_Model();
    }

    public function post_action() {
        $errors = $this->model->validate_data($_POST);
        if (!empty($errors)) {
            echo json_encode($errors, JSON_UNESCAPED_UNICODE);
        } else {
            echo "OK";
        }
    }
}