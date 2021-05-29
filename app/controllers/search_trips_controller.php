<?php
class Search_Trips_Controller extends Controller {
    public function __construct() {
        $this->view = new View();
        $this->model = new Search_Trips_Model();
    }

    public function index_action() {
        $this->view->generate('search_trips_view.php', 'Поиск рейсов');
    }
    
	public function suggest_stations_action() {
		if (!isset($_GET['string']) || empty($_GET['string'])) {
			echo '0';
            return;
		}
        $str = $_GET['string'];
        $stations = $this->model->suggest_stations($str);
        if ($stations === '0') {
            echo '0';
        } else {
            echo json_encode($stations, JSON_UNESCAPED_UNICODE);
        }

	}
}