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

<?php

if ($_SERVER['REQUEST_METHOD']=="POST") {

}

?>