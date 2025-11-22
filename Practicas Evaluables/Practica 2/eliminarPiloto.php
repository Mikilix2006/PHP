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
qué datos se quieren actualizar.

-->

<!DOCTYPE html>
<html>
<head>
    <title>Actualizar datos</title>
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
        Actualizar tabla piloto
    </b></p>
    <br><br><br>
    <form method="POST" action="actualizarPiloto.php">
        <div class="seleccion">
            <div class="seccion">
                DATO ANTIGUO
                <div class="elemento-seccion">
                    <input type="text" name="antiguo" id="antiguo">
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
            <div class="seccion">
                DATO NUEVO
                <div class="elemento-seccion">
                    <input type="text" name="nuevo" id="nuevo">
                </div>
            </div>
        </div>
        <input type="submit" value="Actualizar">
    </form>
    <br><br><br>
    <a href="actualizar.php"><button>ACTUALIZAR OTRA<br>TABLA</button></a>
</body>
</html>

<?php

if ($_SERVER['REQUEST_METHOD']=="POST") {

    $categoria_filled = false;
    $escuderia_filled = false;
    $antiguo_filled = false;
    $nuevo_filled = false;

    try { // try catch para la conexion con la base de datos
        /**
         * __________________
         * |                | █████ ████ ████  █     ████     ████
         * |   ACTUALIZAR   |   █   █  █ █  █  █     █  █     █  █
         * |     TABLA      |   █   ████ █████ █     ████     ████
         * |     PILOTO     |   █   █  █ █   █ █     █  █     █   
         * |________________|   █   █  █ █████ █████ █  █     █   
         * 
         */
        $categoria = $_POST['categoria']; // Recoger informacion del formulario
        $escuderia = $_POST['escuderia']; // Recoger informacion del formulario
        $antiguo = $_POST['antiguo']; // Recoger informacion del formulario
        $nuevo = $_POST['nuevo']; // Recoger informacion del formulario
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
        if (trim($antiguo)!=="")
            $antiguo_filled = true;
        if (trim($categoria)!=="")
            $categoria_filled = true;
        if (trim($escuderia)!=="")
            $escuderia_filled = true;
        if (trim($nuevo)!=="")
            $nuevo_filled = true;
        /**
         * __________________________
         * |                        |
         * | TRATAMIENTO DE ERRORES |
         * |  DE ACTUALIZACION DE   |
         * |        PILOTO          |
         * |________________________|
         * 
         */
        if (!$antiguo_filled && !$nuevo_filled && !$categoria_filled && !$escuderia_filled) {
            echo "<br><br>Introduzca datos válidos.";
        } elseif (!$antiguo_filled) {
            echo "<br><br>La antigua escuderia introducida no es válida. ";
        } elseif (!$nuevo_filled) {
            echo "<br><br>La nueva escuderia introducida no es válida. ";
        } elseif (!$escuderia_filled) {
            echo "<br><br>La escuderia a la que pertenece introducida no es válida. ";
        } elseif (!$categoria_filled) {
            echo "<br><br>La categoria a la que pertenece introducida no es válida. ";
        } else {
            /**
             * _____________________________
             * |                           |
             * | ACTUALIZACION DE REGISTRO |
             * |    EN TABLA ESCUDERIA     |
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
             * == ACTUALIZACION DE DATOS ==
             * Actualizar el piloto
             * especificada por el usuario.
             * 
             * No van a estar permitidas las
             * escuderias repetidas en una
             * misma categoria, tampoco
             * van a estar permitidos
             * los pilotos repetidos
             * dentro de una misma 
             * escuderia.
             * 
             * == INFORME DE ERRORES ==
             * Si da algun error al actualizar
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

                // Comnprobacion de existencias
                $existe_categoria = false;
                $existe_escuderia = false;
                $existe_antiguo_piloto = false;
                $existe_nuevo_piloto = false;
                foreach ($result as $row) {
                    if ($row['nombre_categoria']==$categoria) {
                        $existe_categoria = true;
                        if ($row['nombre_escuderia']==$escuderia) {
                            $existe_escuderia = true;
                            $fkIdEscuderia = $row['fk_id_escuderia'];
                            if ($row['nombre_piloto']==$nuevo) {
                                $existe_nuevo_piloto = true;
                            }
                            if ($row['nombre_piloto']==$antiguo) {
                                $existe_antiguo_piloto = true;
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
                        if ($existe_nuevo_piloto) {
                            echo "<br><br>El nuevo piloto ya existe en la BBDD.";
                        } elseif (!$existe_antiguo_piloto) {
                            echo "<br><br>El antiguo piloto no existe en la BBDD.";
                        } else {
                            // Actualizar piloto
                            $preparada = $bd->prepare("UPDATE piloto 
                                                        SET nombre_piloto = ?
                                                        WHERE nombre_piloto = ?
                                                        AND fk_id_escuderia = ?;");
                            $preparada->execute(array($nuevo, $antiguo, $fkIdEscuderia));
                            echo "<br>Piloto actualizada con éxito<br><br>";
                            echo "VALORES ACTUALIZADOS:<br>";
                            echo "Piloto antiguo: $antiguo<br>";
                            echo "Piloto nuevo: $nuevo<br>";
                            echo "Perteneciente a la escuderia: $escuderia<br>";
                            echo "Perteneciente a la categoría: $categoria";
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