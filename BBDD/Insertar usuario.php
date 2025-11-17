<?php
// datos conexión
$cadena_conexion = 'mysql:dbname=BBDD1;host=127.0.0.1';
$usuario = 'root';
$clave = '';

try {
	// conectar
    $bd = new PDO($cadena_conexion, $usuario, $clave);	
	echo "Conexión realizada con éxito<br>";	
	// insertar nuevo usario
	//$ins = "insert into usuarios(user, password, rol) values('Miguel', 'Miguel123', '1');";
	//$resul = $bd->query($ins);

    //if($resul) {
	//	echo "insert correcto <br>";
	//	echo "Filas insertadas: " . $resul->rowCount() . "<br>";
	//}else print_r( $bd -> errorinfo());	

	$preparada = $bd->prepare("update usuarios set password = ? where password = ?");

    $pass = password_hash("Miguel123", PASSWORD_DEFAULT);
	$chng_pass = "Miguel123";

	$preparada->execute(array($pass,$chng_pass));
	echo "Contraseña hasheada con éxito<br>";	

} catch (PDOException $e) {
	echo 'Error con la base de datos: ' . $e->getMessage();
}
?>