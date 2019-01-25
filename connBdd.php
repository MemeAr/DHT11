<?php
require_once 'config.inc.php';

try {
	$bdd = new PDO('mysql:host='.$host.'; dbname='.$dbname, $username, $password);
	echo "<p>bien connecté a ".$host."</p>";
}

catch(PDOException $pe){
  die('<p>Could not connect to the database $dbname : '.$pe->getMessage().'</p>');
}

$requete = $bdd->prepare('INSERT INTO data(temp, humidity, date) VALUES ('')');