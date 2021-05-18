<!DOCTYPE HTML>
<html lang="RU">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/styles/reset.css">
	<link rel="stylesheet" href="/styles/template.css">
		<?php
		if (!empty($stylesheets)) {
			foreach ($stylesheets as $stylesheet) {
				echo "<link rel=\"stylesheet\" href=\"/styles/$stylesheet.css\">";
			}
		}
	?>
	<title><?php echo $view_title?></title>
</head>
<body>
hi
</body>
</html>
