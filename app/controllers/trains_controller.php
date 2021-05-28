<?php
class Trains_Controller extends Controller {

    public function __construct() {
        $this->view = new View();
        $this->model = new Trains_Model();
    }

    public function index_action() {
        $data = $this->model->get_trains();

        if (!$data)
            $this->view->generate('error404_view.php', 'Страница не найдена');
        else
            $this->view->generate('list_trains_view.php', 'Поезда', ['trains'], $data);
    }

    public function comments_action() {
        if (isset($_POST) && !empty($_POST))
        {
            $this->model->add_comment($_POST['id_train'], $_POST['rating'], $_POST['comment']);
            header("Refresh: 0");
        }
        else {
            $data = $this->model->get_comments();

            if (!$data)
                $this->view->generate('error404_view.php', 'Страница не найдена');
            else
                $this->view->generate('list_train_comments.php', 'Комментарии', ['trains'], $data);
        }
    }

}