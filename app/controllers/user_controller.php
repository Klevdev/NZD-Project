<?php
class User_Controller extends Controller {
    
    public function __construct() {
        $this->model = new User_Model();
    }

    public function signup_action() {
        // TODO валидация
        // TODO валидация
        // TODO валидация
        // TODO валидация
        // TODO валидация
        // TODO валидация
        // TODO валидация
        // TODO валидация
        // TODO валидация
        // TODO валидация
        // TODO валидация
        // TODO валидация
        // TODO валидация
        // TODO валидация
        // TODO валидация
        $surname = $_POST['surname'];
        $name = $_POST['name'];
        $patronymic = !empty($_POST['patronymic']) ? $_POST['patronymic'] : null;
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];

        $operation = $this->model->signup($surname, $name, $patronymic, $email, $phone, $password);
        if ($operation === DB_ERROR) {
            echo "yieks";
            return;
        }
        $this->model->save_to_session(['user' => [
            'id' => $operation['id'],
            'display_name' => $operation['display_name'],
        ]]);
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('Location: '.$host);
        var_dump($_SESSION);
    }

    public function login_action() {
        // TODO валидация
        // TODO валидация
        // TODO валидация
        // TODO валидация
        // TODO валидация
        // TODO валидация
        // TODO валидация
        // TODO валидация
        // TODO валидация
        // TODO валидация
        // TODO валидация
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $operation = $this->model->login($email, $password);
        if ($operation === DB_ERROR) {
            echo "yieks";
            return;
        }

        if ($operation === false) {
            // TODO ошибка пользователя
            echo "No user found";
            return;
        }

        $this->model->save_to_session(['user' => [
            'id' => $operation['id'],
            'display_name' => $operation['display_name'],
        ]]);
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('Location: '.$host);
    }

    public function logout_action(){
        $this->model->remove_from_session('user');
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('Location: '.$host);
    }
}