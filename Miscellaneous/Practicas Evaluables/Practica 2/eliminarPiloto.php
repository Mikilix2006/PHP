<!--
____________________                                       ____________________
|                  |    ████ ████ █   █ ████      ████     |                  |
|    SELECCION     |    █    █  █ █   █ █   █     █   █    |    SELECCION     |
|       CRUD       |    █    ████ █   █ █   █     █   █    |       CRUD       |
|     ELIMINAR     |    █    █ █  █   █ █   █     █   █    |     ELIMINAR     |
|__________________|    ████ █  █ █████ ████      ████     |__________________|


Esta página está dedicada a la ELIMINACIÓN 
de datos de la tabla piloto elegida
por el usuario en un formulario.

Además, se deberá especificar
qué datos se quieren eliminar.

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
        Eliminar de la tabla piloto
    </b></p>
    <br><br><br>
    <form method="POST" action="eliminarPiloto.php">
        <div class="seleccion">
            <div class="seccion">
                DATO A ELIMINAR
                <div class="elemento-seccion">
                    <input type="text" name="piloto" id="piloto">
                </div>
            </div>
            <div class="seccion">
                CONFIRMA EL DATO
                <div class="elemento-seccion">
                    <input type="text" name="confirmacion" id="confirmacion">
                </div>
            </div>
            <div class="seccion">
                DE LA ESCUDERIA
                <div class="elemento-seccion">
                    <input type="text" name="escuderia" id="escuderia">
                </div>
            </div>
            <div class="seccion">
                DE LA CATEGORIA
                <div class="elemento-seccion">
                    <input type="text" name="categoria" id="categoria">
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
    $piloto_filled = false;
    $confirmacion_filled = false;

    try { // try catch para la conexion con la base de datos
        /**
         * __________________
         * |                | █████ ████ ████  █     ████     ████
         * |   ELIMINAR DE  |   █   █  █ █  █  █     █  █     █  █
         * |     TABLA      |   █   ████ █████ █     ████     ████
         * |     PILOTO     |   █   █  █ █   █ █     █  █     █   
         * |________________|   █   █  █ █████ █████ █  █     █   
         * 
         */
        $categoria = $_POST['categoria']; // Recoger informacion del formulario
        $escuderia = $_POST['escuderia']; // Recoger informacion del formulario
        $piloto = $_POST['piloto']; // Recoger informacion del formulario
        $confirmacion = $_POST['confirmacion']; // Recoger informacion del formulario
        /**
         * _______________________
         * |                     |
         * | VALIDAR INFORMACION |
         * |      DE PILOTO      |
         * |_____________________|
         * 
         * == VALIDACIONES MANUALES ==
         * Comprueba que la categoria este informada.
         * Comprueba que la escuderia este informada.
         * Comprueba que el piloto este informado.
         * Si no esta alguna informada pasa a la parte
         * de informe de errores.
         * 
         */
        if (trim($confirmacion)!=="")
            $confirmacion_filled = true;
        if (trim($categoria)!=="")
            $categoria_filled = true;
        if (trim($escuderia)!=="")
            $escuderia_filled = true;
        if (trim($piloto)!=="")
            $piloto_filled = true;
        /**
         * __________________________
         * |                        |
         * | TRATAMIENTO DE ERRORES |
         * |   DE ELIMINACION DE    |
         * |        PILOTO          |
         * |________________________|
         * 
         */
        if (!$piloto_filled && !$confirmacion_filled && !$categoria_filled && !$escuderia_filled) {
            echo "<br><br>Introduzca datos válidos.";
        } elseif (!$piloto_filled) {
            echo "<br><br>El piloto no es válido. ";
        } elseif (!$confirmacion_filled) {
            echo "<br><br>La confirmacion introducida no es válida. ";
        } elseif (!$escuderia_filled) {
            echo "<br><br>La escuderia a la que pertenece introducida no es válida. ";
        } elseif (!$categoria_filled) {
            echo "<br><br>La categoria a la que pertenece introducida no es válida. ";
        } elseif ($piloto != $confirmacion) {
            echo "<br><br>El piloto y la confirmacion deben ser iguales.";
        } else {
            /**
             * _____________________________
             * |                           |
             * |  ELIMINACION DE REGISTRO  |
             * |     EN TABLA PILOTO       |
             * |___________________________|
             * 
             * == ACCION ==
             * El usuario ha seleccionado la
             * opcion "Piloto".
             * 
             * == CONEXION A BBDD ==
             * Conectar con credenciales
             * automaticas a la bbdd.
             * 
             * == ELIMINACION DE DATOS ==
             * Eliminar le piloto
             * especificado por el usuario.
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
                        FROM piloto p 
                        LEFT JOIN escuderia e ON e.id_escuderia = p.fk_id_escuderia 
                        LEFT JOIN categoria c ON c.id_categoria = e.fk_id_categoria
                        ORDER BY id_piloto;';
                        
                $result = $bd->query($sql);

                // Comprobacion de existencias
                $existe_categoria = false;
                $existe_escuderia = false;
                $existe_piloto = false;
                foreach ($result as $row) {
                    if ($row['nombre_categoria']==$categoria) {
                        $existe_categoria = true;
                        $fkIdCategoria = $row['fk_id_categoria'];
                        if ($row['nombre_escuderia']==$escuderia) {
                            $existe_escuderia = true;
                            $fkIdEscuderia = $row['fk_id_escuderia'];
                            if ($row['nombre_piloto']==$piloto) {
                                $existe_piloto = true;
                            }
                        }
                    }
                }
                // Actualizacion de datos
                if (!$existe_categoria) {
                    echo "<br><br>La categoria a la que pertenecen no existe en la base de datos.";
                } else {
                    if (!$existe_escuderia) {
                    echo "<br><br>La escuderia a la que pertenecen no existe en la base de datos.";
                    } else {
                        if (!$existe_piloto) {
                            echo "<br><br>El piloto especificado no existe en la BBDD.";
                        } else {
                            // Eliminar piloto
                            $preparada = $bd->prepare("DELETE FROM piloto
                                                        WHERE fk_id_escuderia IN (
                                                            SELECT id_escuderia
                                                            FROM escuderia
                                                            WHERE fk_id_categoria = (
                                                                SELECT id_categoria
                                                                FROM categoria
                                                                WHERE nombre_categoria = ?));");
                            $preparada->execute(array($categoria));
                            echo "<br>Piloto eliminado con éxito<br><br>";
                        }
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