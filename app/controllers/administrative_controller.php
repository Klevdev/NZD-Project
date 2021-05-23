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
            $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
            header('Location: '.$host);
        }
    }
    
    public function get_trips_action() {
        $page = !empty($_GET['page']) ? $_GET['page'] : 1;
        echo "Check 1";
    } 
    
    public function get_routes_action() {
        $page = !empty($_GET['page']) ? $_GET['page'] : 1;
        echo "Check 2";
    } 
    
    public function get_trains_action() {
        $page = !empty($_GET['page']) ? $_GET['page'] : 1;
        $data['trains'] = $this->model->getTrains($page);
        // echo "<pre>";
        // var_dump($data['trains']);
        // echo "</pre>";
        $data['pagination'] = [
            'cur_page' => $page,
            'pages' => ceil($this->model->count_table_rows('trains') / ELEMENTS_PER_PAGE),
            'href_base' => 'get_trains'
        ];
        
        $this->view->generate('trains_view.php', '', [], $data, null);
    } 

    public function get_messages_action() {
        $page = !empty($_GET['page']) ? $_GET['page'] : 1;
        echo "Check 4";
        
    }

    public function add_train_action() {
        // var_dump($_POST);
        if (!isset($_POST['train_type']) || !isset($_POST['carriages'])) {
            $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
            header('Location: '.$host .'/administrative');
            return;
        }
        $train_type = (int) $_POST['train_type'];
        foreach($_POST['carriages'] as $type => $count) {
            $carriages[(int) $type] = (int) $count;
        }
        if ($this->model->add_train($train_type, $carriages) === true) {
            $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
            header('Location: '.$host .'/administrative');
        }
    }
    
    public function delete_train_action() {
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            return;
        }
        
    }
}