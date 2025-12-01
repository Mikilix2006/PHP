<?php

$array = ['lastname', 'email', 'phone'];
var_dump(implode(",", $array)); // string(20) "lastname,email,phone"

// Devuelve un string vacío si se usa un array vacío:
var_dump(implode('hello', [])); // string(0) ""

// El separador es opcional:
var_dump(implode(['a', 'b', 'c'])); // string(3) "abc"

?>