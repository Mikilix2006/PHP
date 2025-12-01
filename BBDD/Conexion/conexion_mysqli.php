<?php

try {
    // Conexion
    $mysqli = new mysqli("localhost", "adminbbdd1", "1234", "BBDD1");

    if ($mysqli->connect_error)
        throw new Exception("Error de conexión: " . $mysqli->connect_error);

    echo $mysqli->host_info . "<br>";



    // Guardamos los resultados de la consulta
    $result = $mysqli->query("SELECT user FROM usuarios");


    // Mostrar usuarios
    $userno = 1;
    echo "<br>=== 1 SELECT ===<br>";
    foreach ($result as $row) {
        echo " user $userno = " . $row['user'] . "<br>";
        $userno++;
    }



    // Insertar nuevo usuario
    $pass = password_hash('hermenegildo123',PASSWORD_DEFAULT);
    $mysqli->query("INSERT INTO usuarios(user, password, rol) VALUES ('hermenegildo', '$pass, 0)");

    // Guardamos los resultados de la consulta
    $result = $mysqli->query("SELECT user FROM usuarios");

    // Mostrar usuarios
    $userno = 1;
    echo "<br>=== 2 INSERT ===<br>";
    foreach ($result as $row) {
        echo " user $userno = " . $row['user'] . "<br>";
        $userno++;
    }


    // Actualizar datos de usuario
    $pass = password_hash('gabarrindo123',PASSWORD_DEFAULT);
    $mysqli->query("UPDATE  usuarios SET user = 'gabarrindo' WHERE user LIKE 'hermenegildo'");
    $mysqli->query("UPDATE  usuarios SET password = $pass WHERE user LIKE 'gabarrindo'");

    // Guardamos los resultados de la consulta
    $result = $mysqli->query("SELECT user FROM usuarios");

    // Mostrar usuarios
    $userno = 1;
    echo "<br>=== 3 UPDATE ===<br>";
    foreach ($result as $row) {
        echo " user $userno = " . $row['user'] . "<br>";
        $userno++;
    }

    // Eliminar usuario
    $mysqli->query("DELETE FROM usuarios WHERE user LIKE 'gabarrindo'");

    // Guardamos los resultados de la consulta
    $result = $mysqli->query("SELECT user FROM usuarios");

    // Mostrar usuarios
    $userno = 1;
    echo "<br>=== 4 DELETE ===<br>";
    foreach ($result as $row) {
        echo " user $userno = " . $row['user'] . "<br>";
        $userno++;
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

?>