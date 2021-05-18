<?php
class Route {

	static function start() {
    
        // контроллер и действие по умолчанию
		$controller_name = 'Main';
		$action_name = 'index';
		
		$uri = $_SERVER['REQUEST_URI'];
		if (strpos($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
		$routes = explode('/', $uri);

		// получаем имя контроллера
		if ( !empty($routes[1]) ) {	
			$controller_name = $routes[1];
		}
		
		// получаем имя экшена
		if ( !empty($routes[2]) ) {
			$action_name = $routes[2];
		}

		// получаем список параметров
		if (!empty($_GET)) {
			$params = $_GET;
		} else if (!empty($routes[3])) {
			$params = $routes[3];
		}
		// добавляем суффиксы
		$model_name = $controller_name.'_model';
		$controller_name .= '_controller';
		$action_name .= '_action';
		
		/*
		echo "Model: $model_name <br>";
		echo "Controller: $controller_name <br>";
		echo "Action: $action_name <br>";
		*/
		
		// подцепляем файл с классом модели (файла модели может и не быть)
		$model_file = strtolower($model_name).'.php';
		$model_path = "app/models/".$model_file;
		if(file_exists($model_path)) {
			include "app/models/".$model_file;
		}

		// подцепляем файл с классом контроллера
		$controller_file = strtolower($controller_name).'.php';
		$controller_path = "app/controllers/".$controller_file;
		if(file_exists($controller_path)) {
			// создаем контроллер
			include "app/controllers/".$controller_file;
			$controller = new $controller_name;	
		} else {
			Route::ErrorPage404();
		}
		
		if(method_exists($controller, $action_name)) {
			// вызываем действие контроллера
			if (isset($params)) {
				$controller->$action_name($params);
			} else {
				$controller->$action_name();
			}
		} else {
			Route::ErrorPage404();
		}

	}

	static function ErrorPage404()	{
		$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        	header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'error404');
	}
}
