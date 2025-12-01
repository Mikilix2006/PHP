<!--
____________________                                       ____________________
|                  |    ████ ████ █   █ ████      ████     |                  |
|    SELECCION     |    █    █  █ █   █ █   █     █   █    |    SELECCION     |
|       CRUD       |    █    ████ █   █ █   █     █   █    |       CRUD       |
|     ELIMINAR     |    █    █ █  █   █ █   █     █   █    |     ELIMINAR     |
|__________________|    ████ █  █ █████ ████      ████     |__________________|


Esta página está dedicada a la ELIMINACIÓN 
de datos de la tabla categoria elegida
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
        Eliminar de la tabla categoria
    </b></p>
    <br><br><br>
    <form method="POST" action="eliminarCategoria.php">
        <div class="seleccion">
            <div class="seccion">
                DATO A ELIMINAR
                <div class="elemento-seccion">
                    <input type="text" name="categoria" id="categoria" value="<?php if(isset($_POST['categoria'])) { echo $_POST['categoria']; } ?>">
                </div>
            </div>
            <div class="seccion">
                CONFIRMA EL DATO
                <div class="elemento-seccion">
                    <input type="text" name="confirmacion" id="confirmacion" value="<?php if(isset($_POST['categoria'])) { echo $_POST['confirmacion']; } ?>">
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
    $confirmacion_filled = false;

    try { // try catch para la conexion con la base de datos
        /**
         * __________________
         * |                | █████ ████ ████  █     ████     ████
         * |    ELIMINAR    |   █   █  █ █  █  █     █  █     █   
         * |     TABLA      |   █   ████ █████ █     ████     █   
         * |    CATEGORIA   |   █   █  █ █   █ █     █  █     █   
         * |________________|   █   █  █ █████ █████ █  █     ████
         * 
         */
        $categoria = $_POST['categoria']; // Recoger informacion del formulario
        $confirmacion = $_POST['confirmacion']; // Recoger informacion del formulario
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
        if (trim($categoria)!=="")
            $categoria_filled = true;
        if (trim($confirmacion)!=="")
            $confirmacion_filled = true;
        /**
         * __________________________
         * |                        |
         * | TRATAMIENTO DE ERRORES | 
         * |   DE ELIMINACION DE    |
         * |       CATEGORIA        |
         * |________________________|
         * 
         */
        if (!$categoria_filled && !$confirmacion_filled) {
            echo "<br><br>Introduzca datos válidos.";
        } elseif (!$categoria_filled) {
            echo "<br><br>La antigua categoría introducida no es válida. ";
        } elseif (!$confirmacion_filled) {
            echo "<br><br>La nueva categoría introducida no es válida. ";
        } elseif ($categoria != $confirmacion) {
            echo "<br><br>La categoria y la confirmacion no son iguales.";
        } else {
            /**
             * _____________________________
             * |                           |
             * |  ELIMINACION DE REGISTRO  |
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
             * == ELIMINACION DE DATOS ==
             * Eliminar la categoria
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
                        FROM categoria 
                        ORDER BY id_categoria;';
                $result = $bd->query($sql);

                // Comprobacion de existencias
                $existe_categoria = false;
                foreach ($result as $row) {
                    if ($row['nombre_categoria']==$categoria) {
                        $existe_categoria = true;
                    }
                }
                // Eliminacion de datos
                if (!$existe_categoria) {
                    echo "<br><br>La categoria a eliminar no existe en la base de datos.";
                } else {
                    // Eliminar categoria: primero los pilotos
                    $preparada = $bd->prepare("DELETE FROM piloto
                                                WHERE fk_id_escuderia IN (
                                                    SELECT id_escuderia
                                                    FROM escuderia
                                                    WHERE fk_id_categoria = (
                                                        SELECT id_categoria
                                                        FROM categoria
                                                        WHERE nombre_categoria = ?));");
                    $preparada->execute(array($categoria));
                    // Eliminar categoria: segundo las escuderias
                    $preparada = $bd->prepare("DELETE FROM escuderia
                                                WHERE fk_id_categoria = (
                                                    SELECT id_categoria
                                                    FROM categoria
                                                    WHERE nombre_categoria = ?);");
                    $preparada->execute(array($categoria));
                    // Eliminar categoria: con todo eliminado, eliminar categoria
                    $preparada = $bd->prepare("DELETE FROM categoria
                                                WHERE nombre_categoria = ?;");
                    $preparada->execute(array($categoria));

                    echo "<br>Caterogía eliminada con éxito<br><br>";
                }
            }  catch (PDOException $e) {
                    echo 'Error eliminando la categoría => ' . $e->getMessage();
            }
        }
    } catch (PDOException $e) {
        echo 'Error al conectar con la BD: ' . $e->getMessage();
    }
}