<?php
setcookie('nueva', "valor", time() + 3600 * 24);
echo $_COOKIE["nueva"];

$value = 'Valor de prueba';

setcookie("TestCookie", $value);
setcookie("TestCookie", $value, time()+3600);  /* expira en 1 hora */
setcookie("TestCookie", $value, time()+3600, "/~rasmus/", "example.com", true);
?>