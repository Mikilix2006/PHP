<!--
____________________                                       ____________________
|                  |    ████ ████ █   █ ████      ████     |                  |
|    SELECCION     |    █    █  █ █   █ █   █     █   █    |    SELECCION     |
|       CRUD       |    █    ████ █   █ █   █     █   █    |       CRUD       |
|     ELIMINAR     |    █    █ █  █   █ █   █     █   █    |     ELIMINAR     |
|__________________|    ████ █  █ █████ ████      ████     |__________________|


Esta página está dedicada a la ELIMINACIÓN 
de datos de la tabla escuderia elegida
por el usuario en un formulario.

Además, se deberá especificar
qué datos se quieren actualizar.

-->

<!DOCTYPE html>
<html>
<head>
    <title>Eliminar datos</title>
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
    <p><b>
        Eliminar de la tabla escuderia
    </b></p>
    <br><br><br>
    <form method="POST" action="eliminarEscuderia.php">
        <div class="seleccion">
            <div class="seccion">
                DE LA CATEGORIA
                <div class="elemento-seccion">
                    <input type="text" name="categoria" id="categoria">
                </div>
            </div>
            <div class="seccion">
                DATO A ELIMINAR
                <div class="elemento-seccion">
                    <input type="text" name="escuderia" id="escuderia">
                </div>
            </div>
            <div class="seccion">
                CONFIRMA EL DATO
                <div class="elemento-seccion">
                    <input type="text" name="confirmacion" id="confirmacion">
                </div>
            </div>
        </div>
        <input type="submit" value="Eliminar">
    </form>
    <br><br><br>
    <a href="eliminar.php"><button>ELIMINAR DE OTRA<br>TABLA</button></a>
</body>
</html>

<?php

if ($_SERVER['REQUEST_METHOD']=="POST") {

    $categoria_filled = false;
    $escuderia_filled = false;
    $confirmacion_filled = false;

    try { // try catch para la conexion con la base de datos
        /**
         * __________________
         * |                | █████ ████ ████  █     ████     ████
         * |   ACTUALIZAR   |   █   █  █ █  █  █     █  █     █   
         * |     TABLA      |   █   ████ █████ █     ████     ███ 
         * |    ESCUDERIA   |   █   █  █ █   █ █     █  █     █   
         * |________________|   █   █  █ █████ █████ █  █     ████
         * 
         */
        $categoria = $_POST['categoria']; // Recoger informacion del formulario
        $escuderia = $_POST['escuderia']; // Recoger informacion del formulario
        $confirmacion = $_POST['confirmacion']; // Recoger informacion del formulario
        /**
         * _______________________
         * |                     |
         * | VALIDAR INFORMACION |
         * |    DE ESCUDERIA     |
         * |_____________________|
         * 
         * == VALIDACIONES MANUALES ==
         * Comprueba que la categoria este informada.
         * Si no esta informada pasa a la parte
         * de informe de errores.
         * 
         */
        if (trim($categoria)!=="")
            $categoria_filled = true;
        if (trim($escuderia)!=="")
            $escuderia_filled = true;
        if (trim($confirmacion)!=="")
            $confirmacion_filled = true;
        /**
         * __________________________
         * |                        |
         * | TRATAMIENTO DE ERRORES |
         * |  DE ACTUALIZACION DE   |
         * |       ESCUDERIA        |
         * |________________________|
         * 
         */
        if (!$escuderia_filled && !$confirmacion_filled && !$categoria_filled) {
            echo "<br><br>Introduzca datos válidos.";
        } elseif (!$confirmacion_filled) {
            echo "<br><br>La confirmacion de la escuderia introducida no es válida. ";
        } elseif (!$escuderia_filled) {
            echo "<br><br>La escuderia introducida no es válida. ";
        } elseif (!$escuderia_filled) {
            echo "<br><br>La escuderia introducida no es válida. ";
        } elseif ($escuderia != $confirmacion) {
            echo "<br><br>La escuderia y la confirmacion no son iguales.";
        } else {
            /**
             * _____________________________
             * |                           |
             * |  ELIMINACION DE REGISTRO  |
             * |    EN TABLA ESCUDERIA     |
             * |___________________________|
             * 
             * == ACCION ==
             * El usuario ha seleccionado la
             * opcion "Escuderia".
             * 
             * == CONEXION A BBDD ==
             * Conectar con credenciales
             * automaticas a la bbdd.
             * 
             * == ELIMINACION DE DATOS ==
             * Eliminar la escuderia
             * especificada por el usuario.
             * 
             * == INFORME DE ERRORES ==
             * Si da algun error al eliminar
             * los datos, informara al
             * usuario con el problema.
             * 
             */
            try {
                include "CFGINI.php";
                
                // Conexion a BBDD
                $bd = new PDO($cadena_conexion, $usuario, $password);
                echo "<br><br>Conexión a BD correcta<br><br>";

                $sql = 'SELECT * 
                        FROM escuderia e 
                        LEFT JOIN categoria c ON e.fk_id_categoria = c.id_categoria 
                        ORDER BY id_escuderia;';
                $result = $bd->query($sql);

                // Comprobacion de existencias
                $existe_categoria = false;
                $existe_escuderia = false;
                foreach ($result as $row) {
                    if ($row['nombre_categoria']==$categoria) {
                        $id_categoria = $row['id_categoria'];
                        $existe_categoria = true;
                        if ($row['nombre_escuderia']==$escuderia) {
                            $existe_escuderia = true;
                        }
                    }
                }
                // Eliminacion de datos
                if (!$existe_categoria) {
                    echo "<br><br>La categoria a eliminar no existe en la base de datos.";
                } else {
                    if ($existe_escuderia) {
                        // Eliminar escuderia: primero los pilotos
                        $preparada = $bd->prepare("DELETE FROM piloto
                                                    WHERE fk_id_escuderia = (
                                                        SELECT id_escuderia
                                                        FROM escuderia
                                                        WHERE fk_id_categoria = ?);");
                        $preparada->execute(array($id_categoria));
                        // Eliminar escuderia: por ultimo la escuderia
                        $preparada = $bd->prepare("DELETE FROM escuderia
                                                    WHERE fk_id_categoria = ?;");
                        $preparada->execute(array($id_categoria));
                        echo "<br>Escudería eliminada con éxito<br><br>";
                    } else {
                        echo "<br>La escuderia especificada no existe en la BBDD<br><br>";
                    }
                }
            }  catch (PDOException $e) {
                    echo 'Error actualizando la escuderia => ' . $e->getMessage();
            }
        }
    } catch (PDOException $e) {
        echo 'Error al conectar con la BD: ' . $e->getMessage();
    }
}