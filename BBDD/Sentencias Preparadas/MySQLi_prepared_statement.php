<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("localhost", "root", "", "BBDD1");

// Consulta no preparada
$mysqli->query("DROP TABLE IF EXISTS pruebita");
$mysqli->query("CREATE TABLE pruebita(id INT, label TEXT)");

// Consulta preparada, paso 1: preparación
$stmt = $mysqli->prepare("INSERT INTO pruebita(id, label) VALUES (?, ?)");

// Consulta preparada, paso 2: enlaza los valores y ejecuta la consulta
$id = 1;
$label = 'PHP';
$stmt->bind_param("is", $id, $label); // "is" significa que $id está enlazado como un integer y $label como un string

$stmt->execute();

?>