<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Grid Test</title>
		<link href="/views/style/grid.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" media="(min-width: 640px)" href="/views/style/max-640/grid.css" />

    </head>
    <body>
		<?php
		include_once $_SERVER['DOCUMENT_ROOT'] . "/views/common/grid_view.php";
		include_once $_SERVER['DOCUMENT_ROOT'] . "/controls/incident/incident_grid_control.php";
		
		$grid_control = new IncidentGrid_Control();
		
		//$xml_str = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/test/grid/grid_data.xml");
		//$xml = simplexml_load_string($xml_str);
		
		$grid = new GridView($grid_control,"standart");
		$grid->render();
		?>
    </body>
</html>
