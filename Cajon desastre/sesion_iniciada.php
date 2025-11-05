<?php
session_start();
$nombre=$_SESSION['nombre'];
$apellidos=$_SESSION['apellidos'];
echo "Bienvenido . $nombre . $apellidos";
?>