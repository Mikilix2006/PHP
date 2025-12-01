<?php
// Define la fecha de expiración a una hora antes de la fecha actual
setcookie("TestCookie", "", time() - 3600);
setcookie("TestCookie", "", time() - 3600, "/~rasmus/", "example.com", 1);
?>