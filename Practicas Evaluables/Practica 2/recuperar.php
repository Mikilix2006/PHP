<!--
____________________                                      ____________________
|                  |    ████ ████ █   █ ████      ████    |                  |
|    SELECCION     |    █    █  █ █   █ █   █     █  █    |    SELECCION     |
|       CRUD       |    █    ████ █   █ █   █     ████    |       CRUD       |
|    RECUPERAR     |    █    █ █  █   █ █   █     █ █     |    RECUPERAR     |
|__________________|    ████ █  █ █████ ████      █  █    |__________________|


Esta página está dedicada a la RECUPERACIÓN 
de datos de las tablas a elegir
por el usuario en un formulario.

-->

<!DOCTYPE html>
<html>
<head>
    <title>Recuperar datos</title>
    <style>
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        form > input {
            width: 75px;
            height: 25px;
        }
        .seleccion {
            display: flex;
            flex-direction: row;
        }
        .seccion {
            display: flex;
            flex-direction: column;
            width: fit-content;
            margin-right: 25px;
        }
        .elemento-seccion {
            display: flex;
            flex-direction: row;
            margin-top: 2px;
            margin-bottom: 2px;
        }
        li {
            margin: 5px;
        }
    </style>
</head>
<body>
    <p>Este es el panel de RECUPERACION de datos para administradores</p>
    
    <br><br><br>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
        <div class="seleccion">
            <div class="seccion">
                TABLAS
                <div class="elemento-seccion">
                    <input type="checkbox" name="tabla" id="tabla_categoria" value="tabla_categoria">
                    <label for="tabla_categoria">Categoria</label>
                </div>
                <div class="elemento-seccion">
                    <input type="checkbox" name="tabla" id="tabla_escuderia" value="tabla_escuderia">
                    <label for="tabla_escuderia">Escudería</label>
                </div>
                <div class="elemento-seccion">
                    <input type="checkbox" name="tabla" id="tabla_piloto" value="tabla_piloto">
                    <label for="tabla_piloto">Piloto</label>
                </div>
            </div>
        </div>
        <input type="submit" value="Buscar">
    </form>
    <br><br><br>

    <a href="PanelAdministrador.php"><button>Volver al panel<br>de Administrador</button></a>
    <a href="Practica_RA4_RA6_UD3.php"><button>Cerrar sesion</button></a>
</body>
</html>

<?php

if ($_SERVER['REQUEST_METHOD']=="POST") {

    $form_valido = false;

    // Comprobar que la introduccion de datos ha sido correcta
    if (isset($_POST['tabla'])) { // obligatorio)
        $tabla = $_POST['tabla']; // recoger seleccion
        $form_valido = true;
    }

    if ($form_valido) {

        try { // try catch para la conexion con la base de datos
            /**
             * __________________
             * |                | █████ ████ ████  █     ████     ████
             * |   RECUPERAR    |   █   █  █ █  █  █     █  █     █   
             * |     TABLA      |   █   ████ █████ █     ████     █   
             * |    CATEGORIA   |   █   █  █ █   █ █     █  █     █   
             * |________________|   █   █  █ █████ █████ █  █     ████
             * 
             */
            if ($tabla == 'tabla_categoria') {
                try {
                    $cadena_conexion = 'mysql:dbname=BBDD1;host=localhost';
                    $usuario = 'PracticaUD3';
                    $password = '123456';
                    
                    // Conexion a BBDD
                    $bd = new PDO($cadena_conexion, $usuario, $password);
                    echo "<br><br>Conexión a BD correcta<br><br>";

                    $sql = 'SELECT * 
                            FROM categoria 
                            ORDER BY id_categoria;';
                    $result = $bd->query($sql);

                    // Impresión de datos
                    echo "<ul>"; // lista padre
                    echo "<li>TABLA CATEGORÍA:</li>";
                    echo "<ul>"; // lista hija
                    foreach ($result as $row) {
                        echo "<li>CATEGORÍA ".$row['id_categoria'].": ".$row['nombre_categoria']."</li><br>";
                    }
                    echo "</ul>"; // lista hija
                    echo "</ul>"; // lista padre

                }  catch (PDOException $e) {
                        echo 'Error recuperando la categoría => ' . $e->getMessage();
                }
            /**
             * __________________
             * |                | █████ ████ ████  █     ████     ████
             * |   RECUPERAR    |   █   █  █ █  █  █     █  █     █   
             * |     TABLA      |   █   ████ █████ █     ████     ███ 
             * |    ESCUDERIA   |   █   █  █ █   █ █     █  █     █   
             * |________________|   █   █  █ █████ █████ █  █     ████
             * 
             */
            } elseif ($tabla == 'tabla_escuderia') {
                try {
                    $cadena_conexion = 'mysql:dbname=BBDD1;host=localhost';
                    $usuario = 'PracticaUD3';
                    $password = '123456';
                    
                    // Conexion a BBDD
                    $bd = new PDO($cadena_conexion, $usuario, $password);
                    echo "<br><br>Conexión a BD correcta<br><br>";

                    $sql = 'SELECT * 
                            FROM escuderia e 
                            LEFT JOIN categoria c ON e.fk_id_categoria = c.id_categoria 
                            ORDER BY id_escuderia;';
                    $result = $bd->query($sql);

                    // Impresión de datos
                    echo "<ul>"; // lista padre
                    echo "<li>TABLA ESCUDERIA:</li>";
                    echo "<ul>"; // lista hija
                    foreach ($result as $row) {
                        echo "<li>ESCUDERIA ".$row['id_escuderia'].": ".$row['nombre_escuderia']."</li>";
                        echo "<ul><li>Categoría: ".$row['nombre_categoria']."</li></ul><br>";
                    }
                    echo "</ul>"; // lista hija
                    echo "</ul>"; // lista padre

                }  catch (PDOException $e) {
                        echo 'Error recuperando la escuderia => ' . $e->getMessage();
                }
            /**
             * __________________
             * |                | █████ ████ ████  █     ████     ████
             * |    RECUPERAR   |   █   █  █ █  █  █     █  █     █  █
             * |     TABLA      |   █   ████ █████ █     ████     ████   
             * |     PILOTO     |   █   █  █ █   █ █     █  █     █   
             * |________________|   █   █  █ █████ █████ █  █     █
             * 
             */
            } elseif ($tabla == 'tabla_piloto') {
                try {
                    $cadena_conexion = 'mysql:dbname=BBDD1;host=localhost';
                    $usuario = 'PracticaUD3';
                    $password = '123456';
                    
                    // Conexion a BBDD
                    $bd = new PDO($cadena_conexion, $usuario, $password);
                    echo "<br><br>Conexión a BD correcta<br><br>";

                    $sql = 'SELECT * 
                            FROM piloto p 
                            LEFT JOIN escuderia e ON e.id_escuderia = p.fk_id_escuderia 
                            LEFT JOIN categoria c ON c.id_categoria = e.fk_id_categoria
                            ORDER BY id_piloto;';
                    $result = $bd->query($sql);

                    // Impresión de datos
                    echo "<ul>"; // lista padre
                    echo "<li>TABLA PILOTO:</li>";
                    echo "<ul>"; // lista hija
                    foreach ($result as $row) {
                        echo "<li>PILOTO ".$row['id_piloto'].": ".$row['nombre_piloto']."</li>";
                        echo "<ul><li>Escudeŕia: ".$row['nombre_escuderia']."</li>";
                        echo "<li>Categoría: ".$row['nombre_categoria']."</li></ul><br>";
                    }
                    echo "</ul>"; // lista hija
                    echo "</ul>"; // lista padre

                }  catch (PDOException $e) {
                        echo 'Error recuperando el piloto => ' . $e->getMessage();
                }
            }
        } catch (PDOException $e) {
            echo 'Error al conectar con la BD: ' . $e->getMessage();
        }
        
    } else {
        echo "<br><br>Los datos del formulario no son válidos.";
    }
}

?>