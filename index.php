<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="refresh" content="1">
	<meta charset="utf-8">
	<title>Temperature</title>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
	<h1>Température</h1>

	<?php
		$donnees = file_get_contents('data.json');
		$info = json_decode($donnees);

		$bargraph_height = 161 + $info->temperature * 4;
		$bargraph_top = 315 - $info->temperature * 4;

		$filename = 'data.txt'; {
            echo "La météo à été mise à jour le : " . date("d-m-Y   H:i:s.", filectime($filename));
        }
	?>

	<p>Il fait actuellement <?php echo($info -> temperature);?>°C et le taux d'humidité est de <?php echo($info -> humidite);?>%.</p>

	<div id="thermometer">
  		<div id="bargraph" style=<?php echo "\"height:".$bargraph_height."px; top:".$bargraph_top."px;\"";?>></div>
	</div>


</body>
</html>