<!--
____________________                                       ____________________
|                  |    ████ ████ █   █ ████      █   █    |                  |
|    SELECCION     |    █    █  █ █   █ █   █     █   █    |    SELECCION     |
|       CRUD       |    █    ████ █   █ █   █     █   █    |       CRUD       |
|    ACTUALIZAR    |    █    █ █  █   █ █   █     █   █    |    ACTUALIZAR    |
|__________________|    ████ █  █ █████ ████      █████    |__________________|


Esta página está dedicada a la ACTUALIZACIÓN 
de datos de la tabla categoria elegida
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
        Actualizar tabla categoria
    </b></p>
    <br><br><br>
    <form method="POST" action="actualizarCategoria.php">
        <div class="seleccion">
            <div class="seccion">
                DATO ANTIGUO
                <div class="elemento-seccion">
                    <input type="text" name="antiguo" id="antiguo">
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

    $antiguo_filled = false;
    $nuevo_filled = false;

    try { // try catch para la conexion con la base de datos
        /**
         * __________________
         * |                | █████ ████ ████  █     ████     ████
         * |   ACTUALIZAR   |   █   █  █ █  █  █     █  █     █   
         * |     TABLA      |   █   ████ █████ █     ████     █   
         * |    CATEGORIA   |   █   █  █ █   █ █     █  █     █   
         * |________________|   █   █  █ █████ █████ █  █     ████
         * 
         */
        $antiguo = $_POST['antiguo']; // Recoger informacion del formulario
        $nuevo = $_POST['nuevo']; // Recoger informacion del formulario
        /**
         * _______________________
         * |                     |
         * | VALIDAR INFORMACION |
         * |    DE CATEGORIA     |
         * |_____________________|
         * 
         * == VALIDACIONES MANUALES ==
         * Comprueba que la categoria este informada.
         * Si no esta informada pasa a la parte
         * de informe de errores.
         * 
         */
        if (trim($antiguo)!=="")
            $antiguo_filled = true;
        if (trim($nuevo)!=="")
            $nuevo_filled = true;
        /**
         * __________________________
         * |                        |
         * | TRATAMIENTO DE ERRORES |
         * |  DE ACTUALIZACION DE   |
         * |       CATEGORIA        |
         * |________________________|
         * 
         */
        if (!$antiguo_filled && !$nuevo_filled) {
            echo "<br><br>Introduzca datos válidos.";
        } elseif (!$antiguo_filled) {
            echo "<br><br>La antigua categoría introducida no es válida. ";
        } elseif (!$nuevo_filled) {
            echo "<br><br>La nueva categoría introducida no es válida. ";
        } else {
            /**
             * _____________________________
             * |                           |
             * | ACTUALIZACION DE REGISTRO |
             * |    EN TABLA CATEGORIA     |
             * |___________________________|
             * 
             * == ACCION ==
             * El usuario ha seleccionado la
             * opcion "Categoria".
             * 
             * == CONEXION A BBDD ==
             * Conectar con credenciales
             * automaticas a la bbdd.
             * 
             * == ACTUALIZACION DE DATOS ==
             * Actualizar la categoria
             * especificada por el usuario.
             * 
             * No van a estar permitidas las
             * categorías repetidas.
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
                        FROM categoria 
                        ORDER BY id_categoria;';
                $result = $bd->query($sql);

                // Comnprobacion de existencias
                $existe_categoria = false;
                $existe_nueva_categoria = false;
                foreach ($result as $row) {
                    if ($row['nombre_categoria']==$antiguo) {
                        $existe_categoria = true;
                    }
                    if ($row['nombre_categoria']==$nuevo) {
                        $existe_nueva_categoria = true;
                    }
                }
                // Actualizacion de datos
                if (!$existe_categoria) {
                    echo "<br><br>La categoria a actualizar no existe en la base de datos.";
                } else {
                    if ($existe_nueva_categoria) {
                        echo "<br><br>La nueva categoria ya existe en la BBDD.";
                    } else {
                        // Actualizar categoria
                        $preparada = $bd->prepare("UPDATE categoria 
                                                    SET nombre_categoria = ?
                                                    WHERE nombre_categoria = ?;");
                        $preparada->execute(array($nuevo, $antiguo));
                        echo "<br>Caterogía actualizada con éxito<br><br>";
                        echo "VALORES ACTUALIZADOS:<br>";
                        echo "Categoria antigua: $antiguo<br>";
                        echo "Categoria nueva: $nuevo";
                    }
                }
            }  catch (PDOException $e) {
                    echo 'Error actualizando la categoría => ' . $e->getMessage();
            }
        }
    } catch (PDOException $e) {
        echo 'Error al conectar con la BD: ' . $e->getMessage();
    }
}