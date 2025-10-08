<?php

$arr = array("color" => array("blue", "red", "green"),
            "size"  => array("small", "medium", "large"),
            "distance"  => array("near", "far"),
            "height"  => array("low", "high"),
            "weight"  => array("light", "regular", "heavy"));

print_r(array_keys($arr));
print_r(array_values($arr));
var_dump(array_key_exists("color",$arr));
var_dump(array_key_exists("CoLoR",$arr));

?>