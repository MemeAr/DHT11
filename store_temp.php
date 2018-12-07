<?php
$temperature = $_POST['temperature'];
echo ($temperature);

$monFichier = fopen('temperature.txt', 'r+');
fputs($monFichier, $temperature);
fclose($monFichier);

