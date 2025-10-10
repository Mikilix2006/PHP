<?php

/* 
 * Son aquellos arrays a los que les 
 * asocias un indice personalizado
 * denominados clave y valor
 */

$arr1 = array("color" => "rojo", "forma" => "cuadrado");

foreach ($arr1 as $key => $value) {
    echo "Array[". $key ."] => ". $value ."\n";
}

?>
