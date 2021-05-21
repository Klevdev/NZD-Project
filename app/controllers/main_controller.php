<?php
class Main_Controller extends Controller {

	function __construct() {
		$this->view = new View();
		//$this->model = new Main_Model();
	}

	function index_action() {
        $data['is_main_page'] = true;
        $data['is_train_page'] = false;
        $data['is_contacts_page'] = false;
		$this->view->generate('main_view.php', 'Главная страница', ['main-page'], $data);
	}
}
