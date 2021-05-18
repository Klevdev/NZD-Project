<?php
class View {
	
	public function initialize_components($components) {
		include_once 'core/component.php';

		foreach ($components as $component_name) {
			include 'app/components/'.$component_name;
		}
	}

	public function generate($content_view, $view_title, $stylesheets=null, $data=null, $template_view="template_view.php") {
		/*
		$content_view - вид с разметкой целевой страницы
		$view_title - название целевой страницы
		$stylesheet - название дополнительного набора стилей для страницы
		$data - данные из модели
		$template_view - шаблонный вид, куда подставляется $content view, $view_title, $stylesheet, $data
		*/
		
		include 'app/views/'.$template_view;
	}
}
