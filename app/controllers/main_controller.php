<?php
class Main_Controller extends Controller {

	function __construct() {
		$this->view = new View();
		//$this->model = new Main_Model();
	}

	function index_action() {
        $data['is_main_page'] = true;
		$this->view->generate('main_view.php', 'Главная страница', ['main-page'], $data);
	}
}
