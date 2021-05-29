<?php
class Administrative_Controller extends Controller {

    public function __construct() {
        $this->view = new View();
        $this->model = new Administrative_Model();
    }

    public function index_action() {
        $user_id = (isset($_SESSION['user']['id']) && !empty($_SESSION['user']['id'])) ? $_SESSION['user']['id'] : '';
        $check = $this->model->check_privelege($user_id);
        if ($check === DB_ERROR) {
            echo "Ошибка";
            return;
        }
        if ($check) {
            $this->view->generate('administrative_view.php', 'Панель администратора', ['administrative']);
        } else {
            header('Location: /');
        }
    }
    
    public function get_trips_action() {
        $page = !empty($_GET['page']) ? (int) $_GET['page'] : 1;
        $data['trips'] = $this->model->get_trips($page);
        // echo "<pre>";
        // var_dump($data['routes']);
        // echo "</pre>";
        $data['pagination'] = [
            'cur_page' => $page,
            'pages' => ceil($this->model->count_table_rows('trips') / ELEMENTS_PER_PAGE),
            'action' => 'trips'
        ];
        $this->view->generate('trips_view.php', '', [], $data, null);
    }
    
    public function get_routes_action() {
        $page = !empty($_GET['page']) ? (int) $_GET['page'] : 1;
        $data['routes'] = $this->model->get_routes($page);
        // echo "<pre>";
        // var_dump($data['routes']);
        // echo "</pre>";
        $data['pagination'] = [
            'cur_page' => $page,
            'pages' => ceil($this->model->count_table_rows('routes') / ELEMENTS_PER_PAGE),
            'action' => 'routes'
        ];
        $this->view->generate('routes_view.php', '', [], $data, null);
    }

    public function get_routes_list_action() {
        $routes = $this->model->get_routes_list();
        echo json_encode($routes, JSON_UNESCAPED_UNICODE);
    }
    
    public function get_trains_list_action() {
        $trains = $this->model->get_trains_list();
        echo json_encode($trains, JSON_UNESCAPED_UNICODE);
    }

    public function get_trains_action() {
        $page = !empty($_GET['page']) ? (int) $_GET['page'] : 1;
        $data['trains'] = $this->model->get_trains($page);
        // echo "<pre>";
        // var_dump($data['trains']);
        // echo "</pre>";
        $data['pagination'] = [
            'cur_page' => $page,
            'pages' => ceil($this->model->count_table_rows('trains') / ELEMENTS_PER_PAGE),
            'action' => 'trains'
        ];
        $this->view->generate('trains_view.php', '', [], $data, null);
    }

    public function add_trip_action() {
        if (!isset($_POST['id_route']) || !isset($_POST['id_train']) || !isset($_POST['start_time'])) {
            header('Location: /administrative');
            return;
        }
        $id_route = $_POST['id_route'];
        $id_train = $_POST['id_train'];
        $start_time = $_POST['start_time'];

        if ($this->model->add_trip($id_route, $id_train, $start_time) === true) {
            header('Location: /administrative');
        }
    }
    
    public function edit_trip_action() {
        if (!isset($_GET['id']) || !isset($_POST['id_route']) || !isset($_POST['id_train']) || !isset($_POST['start_time'])) {
            header('Location: /administrative');
            return;
        }
        $id_trip = $_GET['id'];
        $id_route = $_POST['id_route'];
        $id_train = $_POST['id_train'];
        $start_time = $_POST['start_time'];

        if ($this->model->edit_trip($id_trip, $id_route, $id_train, $start_time) === true) {
            header('Location: /administrative');
        }
    }

    public function delete_trip_action() {
        if (!isset($_GET['id'])) {
            header('Location: /administrative');
            return;
        }
        $id_trip = $_GET['id'];
        if ($this->model->delete_trip($id_trip) === true) {
            header('Location: /administrative');
        }
    }

    public function add_train_action() {
        // var_dump($_POST);
        if (!isset($_POST['train_type']) || !isset($_POST['carriages'])) {
            header('Location: /administrative');
            return;
        }
        $train_type = (int) $_POST['train_type'];
        foreach($_POST['carriages'] as $type => $count) {
            $carriages[(int) $type] = (int) $count;
        }
        if ($this->model->add_train($train_type, $carriages) === true) {
            header('Location: /administrative');
        }
    }   

    public function delete_train_action() {
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            header('Location: /administrative');
            return;
        }
        if ($this->model->delete_train($_GET['id']) === true) {
            header('Location: /administrative');
        }
    }

    public function get_messages_action() {
        $page = !empty($_GET['page']) ? (int) $_GET['page'] : 1;
        
        $data['messages'] = $this->model->get_messages($page);
        $data['pagination'] = [
            'cur_page' => $page,
            'pages' => ceil($this->model->count_table_rows('messages') / ELEMENTS_PER_PAGE),
            'action' => 'messages'
        ];
        $this->view->generate('messages_view.php', '', [], $data, null);
    }

    public function change_message_state_action() {
        if (!isset($_GET['id']) || !isset($_GET['state'])) {
            header('Location: /administrative');
            return;
        }
        
        if ($this->model->change_message_state($_GET['id'], $_GET['state']) === true) {
            header('Location: /administrative');
        }
    }

    public function delete_message_action() {
        // var_dump($_POST);
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            header('Location: /administrative');
            return;
        }
        if ($this->model->delete_message($_GET['id']) === true) {
            header('Location: /administrative');
        }
    }

}