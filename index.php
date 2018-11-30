<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Temperature</title>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
	<h1>Température</h1>

	<?php
		// function lecture($fichier) {
		// 	$monFichier = file_get_contents('data.txt');
		// 	var_dump(json_decode($monFichier));
		// }

		// $fichier = '/var/www/html/DHT11/data.txt';
		// lecture($fichier);

		$donnees = file_get_contents('data.txt');
		$info = json_decode($donnees);
	?>

	<p>Il fait actuellement <?php echo($info -> temperature)?> et le taux d'humidité est de <?php echo($info -> humidite)?></p>



</body>
</html>