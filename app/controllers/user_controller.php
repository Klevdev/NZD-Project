<?php
class User_Controller extends Controller {
    
    public function __construct() {
        $this->view = new View();
        $this->model = new User_Model();
    }

    public function signup_action() {
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
            'role' => $operation['role']
        ]]);
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('Location: '.$host);
    }

    public function login_action() {
        if (!isset($_POST['email']) || !isset($_POST['password']) || empty($_POST['email']) || empty($_POST['password'])) {
            echo "yeiks";
            return;
        }
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $operation = $this->model->login($email, $password);
        if ($operation === DB_ERROR) {
            echo "yieks";
            return;
        }

        if ($operation === false) {
            // TODO ошибка пользователя
            echo "NO_USER_FOUND";
            return;
        }

        $this->model->save_to_session(['user' => [
            'id' => $operation['id'],
            'display_name' => $operation['display_name'],
            'role' => $operation['role']
        ]]);
        echo "OK";
    }

    public function logout_action(){
        $this->model->remove_from_session('user');
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('Location: '.$host);
    }

    public function orders_action() {
        if(isset($_GET['id']) && !empty($_GET['id']))
        {
            $data = $this->model->get_seats();

            if (!$data)
                $this->view->generate('error404_view.php', 'Страница не найдена');
            else
                $this->view->generate('order_seats_view.php', 'История заказов', ['trains'], $data);
        }
        else
        {
            $data = $this->model->get_orders();
            $this->view->generate('order_history_view.php', 'История заказов', ['trains'], $data);
        }
    }
}