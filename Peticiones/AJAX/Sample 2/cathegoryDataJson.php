<?php
	$array = array(
		array("cod" => 1, "nombre" => "Comida"),
		array("cod" => 2, "nombre" => "Bebida"),
		array("cod" => 3, "nombre" => "Barrita"),
		array("cod" => 4, "nombre" => "Agua"),
		array("cod" => 5, "nombre" => "Frutas"),
		array("cod" => 6, "nombre" => "Postres")
	);
	$json = json_encode($array);	
	echo $json;
?>