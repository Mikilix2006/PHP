<?php

$arr_esca = array("rojo", "azul", "verde", "marron", "negro", "amarillo", "rosa");
$arr_asoc = array("color" => array("blue", "red", "green"),
                "size"  => array("small", "medium", "large"),
                "distance"  => array("near", "far"),
                "height"  => array("low", "high"),
                "weight"  => array("light", "regular", "heavy"));

sort($arr_esca);
print_r($arr_esca);

rsort($arr_asoc);
print_r($arr_asoc);

?>