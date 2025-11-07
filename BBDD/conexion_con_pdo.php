<?php

try {
    $dbh = new PDO('mysql:host=localhost;dbname=test', "root", "");
    throw new PDOException("PP");
    $dbh = new PDO('mysql:host=localhost;dbname=test', "root", "");
} catch (PDOException $e) {
    echo "Ha ocurrido un error: " . $e->getMessage();
}

?>