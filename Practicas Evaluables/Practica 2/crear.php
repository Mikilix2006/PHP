<!--

____________________    ████ ████ █   █ ████      ████    ____________________
|                  |    █    █  █ █   █ █   █     █       |                  |
|    SELECCION     |    █    ████ █   █ █   █     █       |    SELECCION     |
|    CRUD CREAR    |    █    █ █  █   █ █   █     █       |    CRUD CREAR    |
|__________________|    ████ █  █ █████ ████      ████    |__________________|


Esta página está dedicada a la CREACIÓN 
de un registro en una tabla a elegir
por el usuario en un formulario.

Además, se deberá especificar
qué datos se quieren introducir.

-->

<!DOCTYPE html>
<html>
<head>
    <title>Crear Registro</title>
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
    </style>
</head>
<body>
    <p>Este es el panel de CREACIÓN de registros para administradores</p>
    
    <br><br><br>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
        <div class="seleccion">
            <div class="seccion">
                TABLA
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
                DATOS
                <div class="elemento-seccion">
                    <label for="categoria">Categoria: </label>
                    <input type="text" name="categoria" id="categoria">
                </div>
                <div class="elemento-seccion">
                    <label for="escuderia">Escudería: </label>
                    <input type="text" name="escuderia" id="escuderia">
                </div>
                <div class="elemento-seccion">
                    <label for="piloto">Piloto: </label>
                    <input type="text" name="piloto" id="piloto">
                </div>
            </div>
        </div>
        <input type="submit" value="Enviar">
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

        $categoria_filled = false;
        $escuderia_filled = false;
        $piloto_filled = false;

        try { // try catch para la conexion con la base de datos
            /**
             * __________________
             * |                | █████ ████ ████  █     ████     ████
             * |    CREAR EN    |   █   █  █ █  █  █     █  █     █   
             * |     TABLA      |   █   ████ █████ █     ████     █   
             * |    CATEGORIA   |   █   █  █ █   █ █     █  █     █   
             * |________________|   █   █  █ █████ █████ █  █     ████
             * 
             */
            if ($tabla == 'tabla_categoria') {
                $categoria = $_POST['categoria']; // Recoger informacion del formulario
                /**
                 * _______________________
                 * |                     |
                 * | VALIDAR INFORMACION |
                 * |    DE CATEGORIA     |
                 * |_____________________|
                 * 
                 * == VALIDACIONES MANUALES ==
                 * Comprueba que la categoria exista.
                 * Si no existe pasa a la parte
                 * de informe de errores.
                 * 
                 */
                if (trim($categoria)!=="")
                    $categoria_filled = true;
                /**
                 * __________________________
                 * |                        |
                 * | TRATAMIENTO DE ERRORES |
                 * |    DE INSERCION DE     |
                 * |       CATEGORIA        |
                 * |________________________|
                 * 
                 */
                if (!$categoria_filled) {
                    echo "La categoría introducida no es válida. ";
                } else {
                    /**
                     * ____________________________
                     * |                          |
                     * | INTRODUCCION DE REGISTRO |
                     * |    A TABLA CATEGORIA     |
                     * |__________________________|
                     * 
                     * == ACCION ==
                     * El usuario ha seleccionado las
                     * opciones "Crear registro" y
                     * "Categoria".
                     * 
                     * == CONEXION A BBDD ==
                     * Conectar con credenciales
                     * automaticas a la bbdd.
                     * 
                     * == INTRODUCCION DE DATOS ==
                     * Introducir la categoria
                     * especificada por el usuario.
                     * 
                     * No van a estar permitidas las
                     * categorías repetidas
                     * 
                     * == INFORME DE ERRORES ==
                     * Si da algun error al introducir
                     * los datos, informara al
                     * usuario con el problema.
                     * 
                     */
                    $cadena_conexion = 'mysql:dbname=BBDD1;host=localhost';
                    $usuario = 'PracticaUD3';
                    $password = '123456';
                    
                    // Conexion a BBDD
                    $bd = new PDO($cadena_conexion, $usuario, $password);
                    echo "<br><br>Conexión a BD correcta<br><br>";
                
                    try {
                        $sql = 'SELECT * FROM escuderia;';
                        $result = $bd->query($sql);
                        $existe_escuderia = false;
                        foreach ($result as $row) {
                            if ($row['nombre_escuderia'] == $escuderia) {
                                $existe_escuderia = true;
                            }
                        }
                        if (!$existe_categoria) {
                            $preparada = $bd->prepare("INSERT INTO categoria(nombre_categoria) VALUES(?);");
                            $preparada->execute(array($categoria));
                            echo "Caterogía insertada con éxito<br><br>";
                            echo "VALORES INSERTADOS:<br>";
                            echo "Categoria: $categoria";
                        } else {
                            echo "Esa categoría ya existe en la base de datos.";
                        }
                    }  catch (PDOException $e) {
                        echo 'Error insertando la categoría => ' . $e->getMessage();
                    }
                }
            /**
             * __________________
             * |                | █████ ████ ████  █     ████     ████
             * |    CREAR EN    |   █   █  █ █  █  █     █  █     █   
             * |     TABLA      |   █   ████ █████ █     ████     ███ 
             * |    ESCUDERIA   |   █   █  █ █   █ █     █  █     █   
             * |________________|   █   █  █ █████ █████ █  █     ████
             * 
             */
            } elseif ($tabla == 'tabla_escuderia') {
                $categoria = $_POST['categoria']; // recoger informacion del formulario
                $escuderia = $_POST['escuderia']; // recoger informacion del formulario
                /**
                 * _______________________
                 * |                     |
                 * | VALIDAR INFORMACION |
                 * |   DE CATEGORIA Y    |
                 * |      ESCUDERIA      |
                 * |_____________________|
                 * 
                 * == VALIDACIONES MANUALES ==
                 * Comprueba que la categoria exista.
                 * Si no existe pasa a la parte
                 * de informe de errores.
                 * En caso de que exista, guardara
                 * el ID de la categoria en cuestion.
                 * 
                 * Si la escuderia no está informada,
                 * se le notificará al usuario.
                 * 
                 */
                if (trim($categoria)!=="")
                    $categoria_filled = true;
                if (trim($escuderia)!=="")
                    $escuderia_filled = true;
                /**
                 * __________________________
                 * |                        |
                 * | TRATAMIENTO DE ERRORES |
                 * |     DE INSERCION DE    |
                 * |        ESCUDERIA       |
                 * |________________________|
                 * 
                 */
                if (!$categoria_filled) {
                    echo "La categoría introducida no es válida.";
                } elseif (!$escuderia_filled) {
                    echo "La escudería introducida no es válida.";
                } else {
                    /**
                     * ____________________________
                     * |                          |
                     * | INTRODUCCION DE REGISTRO |
                     * |    A TABLA ESCUDERIA     |
                     * |__________________________|
                     * 
                     * == ACCION ==
                     * El usuario ha seleccionado las
                     * opciones "Crear registro" y
                     * "Escuderia".
                     * 
                     * == CONEXION A BBDD ==
                     * Conectar con credenciales
                     * automaticas a la bbdd.
                     * 
                     * == INTRODUCCION DE DATOS ==
                     * Introducir la escuderia y a
                     * que categoria pertenece
                     * especificadas por el usuario.
                     * 
                     * No van a estar permitidas las
                     * escuderias repetidas dentro 
                     * de una misma categoria.
                     * 
                     * == INFORME DE ERRORES ==
                     * Si da algun error al introducir
                     * los datos, informara al
                     * usuario con el problema.
                     * 
                    */
                    $cadena_conexion = 'mysql:dbname=BBDD1;host=localhost';
                    $usuario = 'PracticaUD3';
                    $password = '123456';
                    
                    // Conexion a BBDD
                    $bd = new PDO($cadena_conexion, $usuario, $password);
                    echo "<br><br>Conexión a BD correcta<br><br>";
                    
                    try {
                        /**
                         * _____________________
                         * |                   |
                         * |  CONVERTIR DATOS  |
                         * |      A IDs        |
                         * |___________________|
                         * 
                         * == RECOGER DATOS EXISTENTES == 
                         * Hace una consulta a la base
                         * de datos recogiendo todas
                         * las categorias.
                         * 
                         * == CONVERSION DE DATOS ==
                         * Convierte la categoría a su
                         * correspondiente id_categoria.
                         * 
                         * == INFORME DE ERRORES ==
                         * En caso de que la categoria no
                         * exista, se informará al usuario.
                         * 
                         * == CONFIRMACION ==
                         * Si no ha habido ningún fallo
                         * insertando el nuevo registro
                         * en la tabla categoria,
                         * el usuario sera notificado
                         * 
                         */
                        $sql = 'SELECT * FROM categoria;';
                        $result = $bd->query($sql);
                        $existe_categoria = false;
                        foreach ($result as $row) {
                            if ($row['nombre_categoria'] == $categoria) {
                                $categoria = $row['id_categoria'];
                                $existe_categoria = true;
                            }
                        }
                        if ($existe_categoria) {
                            $sql = 'SELECT * FROM escuderia;';
                            $result = $bd->query($sql);
                            $existe_escuderia = false;
                            foreach ($result as $row) {
                                if ($row['nombre_categoria'] == $categoria) {
                                    $existe_escuderia = true;
                                }
                            }
                        }
                        if ($existe_escuderia) {
                            if ($existe_categoria) {
                                $preparada = $bd->prepare("INSERT INTO escuderia(nombre_escuderia,fk_id_categoria) VALUES(?,?)");
                                $preparada->execute(array($escuderia,$categoria));
                                echo "Caterogía insertada con éxito<br><br>";
                                echo "VALORES INSERTADOS:<br>";
                                echo "Categoria (fk_id_categoria): $categoria<br>";
                                echo "Escuderia: $escuderia<br>";
                            } else {
                                echo "No existe esa categoría en la base de datos.";
                            }
                        } else {
                            echo "Esa escuderia ya existe en la categoria especificada.";
                        }
                        
                    }  catch (PDOException $e) {
                        echo 'Error insertando la escuderia => ' . $e->getMessage();
                    }
                }
            /**
             * __________________
             * |                | █████ ████ ████  █     ████     ████
             * |    CREAR EN    |   █   █  █ █  █  █     █  █     █  █
             * |     TABLA      |   █   ████ █████ █     ████     ████   
             * |     PILOTO     |   █   █  █ █   █ █     █  █     █   
             * |________________|   █   █  █ █████ █████ █  █     █
             * 
             */
            } elseif ($tabla == 'tabla_piloto') {
                echo "Crear piloto";
                $categoria = $_POST['categoria']; // recoger informacion del formulario
                $escuderia = $_POST['escuderia']; // recoger informacion del formulario
                $piloto = $_POST['piloto']; // recoger informacion del formulario
                /**
                 * _______________________
                 * |                     |
                 * | VALIDAR INFORMACION |
                 * |    DE CATEGORIA,    |
                 * |     ESCUDERIA Y     |
                 * |       PILOTO        |
                 * |_____________________|
                 * 
                 * == VALIDACIONES MANUALES ==
                 * Comprueba que la categoria exista.
                 * Si no existe pasa a la parte
                 * de informe de errores.
                 * En caso de que exista, guardara
                 * el ID de la categoria en cuestion.
                 * 
                 * Hace lo mismo con la categoría.
                 * 
                 * Si el piloto no está informado,
                 * se le notificará al usuario.
                 * 
                 */
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
                 * |    DE INSERCION DE     |
                 * |         PILOTO         |   
                 * |________________________|
                 * 
                 */
                if (!$categoria_filled) {
                    echo "La categoría introducida no es válida.";
                } elseif (!$escuderia_filled) {
                    echo "La escudería introducida no es válida.";
                } elseif (!$piloto_filled) {
                    echo "El piloto introducido no es válido.";
                } else {
                    /**
                     * ____________________________
                     * |                          |
                     * | INTRODUCCION DE REGISTRO |
                     * |     A TABLA PILOTO       |
                     * |__________________________|
                     * 
                     * == ACCION ==
                     * El usuario ha seleccionado las
                     * opciones "Crear registro" y
                     * "Piloto".
                     * 
                     * == CONEXION A BBDD ==
                     * Conectar con credenciales
                     * automaticas a la bbdd.
                     * 
                     * == INTRODUCCION DE DATOS ==
                     * Introducir el piloto y a
                     * que escuderia y categoria pertenece
                     * especificadas por el usuario.
                     * 
                     * == INFORME DE ERRORES ==
                     * Si da algun error al introducir
                     * los datos, informara al
                     * usuario con el problema.
                     * 
                     */
                    $cadena_conexion = 'mysql:dbname=BBDD1;host=localhost';
                    $usuario = 'PracticaUD3';
                    $password = '123456';
                    
                    // Conexion a BBDD
                    $bd = new PDO($cadena_conexion, $usuario, $password);
                    echo "<br><br>Conexión a BD correcta<br><br>";
                    
                    try {
                        /**
                         * _____________________
                         * |                   |
                         * |  CONVERTIR DATOS  |
                         * |      A IDs        |
                         * |___________________|
                         * 
                         * == RECOGER DATOS EXISTENTES == 
                         * Hace una consulta a la base
                         * de datos recogiendo todas
                         * las categorias y escuderias.
                         * 
                         * Se necesitará conseguir el
                         * id de la escuderia a partir
                         * de la categoria que se
                         * introduzca para con el id 
                         * de la escuderia, si existe,
                         * introducirla con el piloto.
                         * 
                         * == CONVERSION DE DATOS ==
                         * Convierte de sus respectivas
                         * tablas, la categoría a su
                         * correspondiente id_categoria
                         * y la escuderia a su
                         * correspondiente id_categoria.
                         * 
                         * == INFORME DE ERRORES ==
                         * En caso de que alguno de los
                         * datos introducidos no
                         * exista, se informará al usuario.
                         * 
                         * == CONFIRMACION ==
                         * Si no ha habido ningún fallo
                         * insertando el nuevo registro
                         * en la tabla piloto,
                         * el usuario sera notificado
                         * 
                         */
                        // CONVERSION 1 --> CATEGORIA A ID
                        $sql = 'SELECT * FROM categoria;';
                        $result = $bd->query($sql);
                        $existe_categoria = false;
                        foreach ($result as $row) {
                            if ($row['nombre_categoria'] == $categoria) {
                                $categoria = $row['id_categoria'];
                                $existe_categoria = true;
                            }
                        }
                        if ($existe_categoria) {
                            // CONVERSION 2 -- ESCUDERIA A ID
                            $preparada = $bd->prepare("SELECT * FROM escuderia WHERE fk_id_categoria = ?");
                            $preparada->execute(array($categoria));
                            $existe_escuderia = false;
                            foreach ($preparada as $row) {
                                if ($row['nombre_escuderia'] == $escuderia) {
                                    $escuderia = $row['id_escuderia'];
                                    $existe_escuderia = true;
                                }
                            }

                            if ($existe_escuderia) {
                                $preparada = $bd->prepare("SELECT * FROM piloto WHERE fk_id_escuderia = ?");
                                $preparada->execute(array($escuderia));
                                $existe_piloto = false;
                                foreach ($preparada as $row) {
                                    if ($row['nombre_piloto'] == $piloto) {
                                        $existe_piloto = true;
                                    }
                                }

                                if ($existe_piloto) {
                                    echo "Ese piloto en esa escuderia y categoria ya existe en la base de datos.";
                                } else {
                                    $preparada = $bd->prepare("INSERT INTO piloto(nombre_piloto,fk_id_escuderia) VALUES(?,?)");
                                    $preparada->execute(array($piloto,$escuderia));
                                    echo "Caterogía insertada con éxito<br><br>";
                                    echo "VALORES INSERTADOS:<br>";
                                    echo "Categoria (fk_id_categoria): $categoria<br>";
                                    echo "Escuderia (fk_id_categoria): $escuderia<br>";
                                    echo "Piloto: $piloto<br>";
                                }

                            } else {
                                echo "La escudería de la categoría introducida no existe en la base de datos.";
                            }

                        } else {
                            echo "La categoría introducida no existe en la base de datos.";
                        }

                    }  catch (PDOException $e) {
                        echo 'Error insertando el piloto => ' . $e->getMessage();
                    }
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