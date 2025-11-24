<?php

session_start();

if (!isset($_COOKIE['visitas_admin'])){
		setcookie('visitas_admin', '1', time() + 3600 * 24);
		echo "Hola " . $_SERVER['nombre'] . "! Bienvenido por primera vez";
	}else{
		$visitas_admin = (int) $_COOKIE['visitas_admin'];
		
		$visitas_admin++;
		setcookie('visitas_admin', $visitas_admin, time() + 3600 * 24);
		echo "Hola " . $_SERVER['nombre'] . "! Bienvenido por $visitas_admin º vez";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Panel Administrador</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: fit-content;
            margin:auto;
        }
        a {
            margin: 5px;
        }
    </style>
</head>
<body>
    <p>Este es el panel de administrador</p>
    
    <a href="crear.php"><button>Crear registro</button></a>
    <a href="recuperar.php"><button>Recuperar datos</button></a>
    <a href="actualizar.php"><button>Actualizar tabla</button></a>
    <a href="eliminar.php"><button>Eliminar registro</button></a>
    <a href="Practica_RA4_RA6_UD3.php"><button>Cerrar sesion</button></a>
</body>
</html>