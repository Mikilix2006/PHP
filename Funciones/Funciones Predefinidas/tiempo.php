<?php

echo time();
echo "\n";
echo microtime();
echo "\n";
echo microtime();
echo "\n";


$timestamp = time();
$fecha = date("d-Y H:i:s", $timestamp);
echo $fecha;

$fecha2 = getdate();

print_r($fecha2);


?>