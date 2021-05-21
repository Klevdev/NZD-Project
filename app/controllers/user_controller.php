<?php
class User_Controller extends Controller {
    
    public function __construct() {
        $this->model = new User_Model();
    }

    public function signup_action() {
        // TODO валидация
        $surname = $_POST['surname'];
        $name = $_POST['name'];
        $patronymic = !empty($_POST['patronymic']) ? $_POST['patronymic'] : null;
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];

        $operation = $this->model->signup($surname, $name, $patronymic, $email, $phone, $password);
        if ($operation !== DB_ERROR) {
            $this->model->save_to_session(['user' => [
                'id' => $operation,
                'display_name' => strtoupper(substr($name, 0, 1)).'. '.$surname,
            ]]);
            $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
            header('Location: '.$host.'/');
        }
    }

    public function login() {
    }
}