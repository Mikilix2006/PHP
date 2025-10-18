<?php
echo $_SERVER['SERVER_NAME'];
echo '<br>';
echo $_SERVER['SERVER_ADMIN'];
echo '<br>';
echo $_SERVER['SERVER_PORT'];
echo '<br>';
echo $_ENV["USER"];
define("CONSTANTE","Carcamusa");
define("SALUDO","Hola mundo");
echo CONSTANTE, ". ", SALUDO,'<br>';

phpinfo();

?>
