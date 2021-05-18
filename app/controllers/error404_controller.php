<?php
class Error404_Controller extends Controller {
	
	function index_action()	{
		$this->view->generate('error404_view.php', 'Страница не найдена');
    }
    
}
