<?php
class Pagination_Component {
	
	static function build($cur_page, $pages, $action) {
		/*
		$params = переданные GET параметры

		$nearest_pages_shown - кол-во страниц, отображаемых "рядом" с текущей страницей (константа (ну типа))
		*/
		$nearest_pages_shown = 2; // кол-во страниц (ссылок), отображаемых в пагинации рядом с текущей

		$link_start = "<a href='#' onclick=getPage('$action',";
		$link_center = ")>";
		$link_end = '</a>';
		
		echo "<div class='pagination'><span>Страницы:</span>";

		if ($cur_page != 1) echo $link_start . 1 . $link_center . 1 . $link_end;
		else echo "<span class='current-page'>1</span>";

		$flag = false;
		for ($page = 2; $page <= $pages - 1; $page++) {
			if ($page == $cur_page) {
				echo "<span class='current-page'>$page</span>";
				continue;
			}
			if ($page >= $cur_page - $nearest_pages_shown && $page <= $cur_page + $nearest_pages_shown) {
				echo $link_start . $page . $link_center . $page . $link_end;
				$flag = false;
			} else if ($flag === false) {
				$flag = true;
				echo "<span>...</span>";
			}
			// if ($page < $pages && $flag === false) echo ", ";
		}
		if ($pages > 1)
			if ($cur_page != $pages) echo $link_start . $pages . $link_center .  $pages . $link_end;
			else echo "<span class='current-page'>$pages</span>";
		
		echo "</div>";
	}
}