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
    
    public function trips_ajax_action($page=1) {
        
        
    } 
    
    public function routes_ajax_action($page=1) {
        
    } 
    
    public function trains_ajax_action($page=1) {
        
    } 

    public function messages_ajax_action($page=1) {
        
    } 
}