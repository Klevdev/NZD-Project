<?php
class Feedback_Controller extends Controller {
    public function __construct() {
        $this->view = new View();
        $this->model = new Feedback_Model();
    }

    public function send_message_action() {
        $result = $this->model->send_message();
        if ($result) {
            echo "OK";
        } else {
            echo $result;
        }
    }
}