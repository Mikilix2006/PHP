<!--
____________________                                       ____________________
|                  |    ████ ████ █   █ ████      █   █    |                  |
|    SELECCION     |    █    █  █ █   █ █   █     █   █    |    SELECCION     |
|       CRUD       |    █    ████ █   █ █   █     █   █    |       CRUD       |
|    ACTUALIZAR    |    █    █ █  █   █ █   █     █   █    |    ACTUALIZAR    |
|__________________|    ████ █  █ █████ ████      █████    |__________________|


Esta página está dedicada a la ACTUALIZACIÓN 
de datos de las tablas a elegir
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
    <p>Este es el panel de ACTUALIZACIÓN de datos para administradores</p>
    
    <br><br><br>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
        <div class="seleccion">
            <div class="seccion">
                TABLAS
                <div class="elemento-seccion">
                    <input type="radio" name="tabla" id="tabla_categoria" value="tabla_categoria">
                    <label for="tabla_categoria">Categoria</label>
                </div>
                <div class="elemento-seccion">
                    <input type="radio" name="tabla" id="tabla_escuderia" value="tabla_escuderia">
                    <label for="tabla_escuderia">Escudería</label>
                </div>
                <div class="elemento-seccion">
                    <input type="radio" name="tabla" id="tabla_piloto" value="tabla_piloto">
                    <label for="tabla_piloto">Piloto</label>
                </div>
            </div>
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
            if ($tabla == 'tabla_categoria') {
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
                 * |    DE INSERCION DE     |
                 * |       CATEGORIA        |
                 * |________________________|
                 * 
                 */
                if (!$antiguo_filled) {
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
            /**
             * __________________
             * |                | █████ ████ ████  █     ████     ████
             * |   ACTUALIZAR   |   █   █  █ █  █  █     █  █     █   
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

                }  catch (PDOException $e) {
                        echo 'Error insertando la categoría => ' . $e->getMessage();
                }
            /**
             * __________________
             * |                | █████ ████ ████  █     ████     ████
             * |   ACTUALIZAR   |   █   █  █ █  █  █     █  █     █  █
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

                }  catch (PDOException $e) {
                        echo 'Error insertando la categoría => ' . $e->getMessage();
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