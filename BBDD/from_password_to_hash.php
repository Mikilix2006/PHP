<?php

$cadena_conexion = 'mysql:dbname=BBDD1;host=127.0.0.1';
$usuario = 'root';
$password = '';
try {
    // conexion
    $bd = new PDO($cadena_conexion, $usuario, $password);
	echo "Conexión realizada con éxito<br>";
    // prepared statement
    $preparada = $bd->prepare("update usuarios set password = ? where password = ?");
    // Recuperar y almacenar datos
    $sql = 'SELECT user, password, rol FROM usuarios';
    $result = $bd->query($sql);
    foreach ($result as $row) {
        // Actualizar contraseñas
        $preparada->execute(array(password_hash($row['password'], PASSWORD_DEFAULT),$row['password']));
        echo "Contraseña de " . $row['user'] . " actualizada <br>";
    }
} catch (PDOException $e) {
	echo 'Error con la base de datos: ' . $e->getMessage();
}

?>