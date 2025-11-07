<?php
$cadena_conexion = 'mysql:dbname=BBDD1;host=127.0.0.1';
$usuario = 'root';
$password = '';
try {
    $bd = new PDO($cadena_conexion, $usuario, $password);
	echo "Conexión realizada con éxito<br>";		
	$sql = 'SELECT user, password, rol FROM usuarios';
	$usuarios = $bd->query($sql);
	echo "Número de usuarios: " . $usuarios->rowCount() . "<br>";
	foreach ($usuarios as $usu) {
		print "Nombre : " . $usu['user'];
		print " -> Clave  : " . $usu['password'] . "<br>";
	}
	/* consulta preparada, parametros por orden */	
	$preparada = $bd->prepare("select user from usuarios where rol = ?");	
	$preparada->execute( array(0));
	echo "Usuarios con rol 0: " .  $preparada->rowCount() . "<br>";
	foreach ($preparada as $usu) {
		print "Nombre : " . $usu['user'] . "<br>";
	}
	/* consulta preparada, parametros por user */	
	$preparada_user = $bd->prepare("select user from usuarios where rol = :rol");
	$preparada_user->execute( array(':rol' => 1));
	echo "Usuarios con rol 1: " .  $preparada->rowCount() . "<br>";
	foreach ($preparada_user  as $usu) {
		print "Nombre : " . $usu['user'] . "<br>";
	}	
} catch (PDOException $e) {
	echo 'Error con la base de datos: ' . $e->getMessage();
}

?>