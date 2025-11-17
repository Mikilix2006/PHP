<!DOCTYPE html>
<html>
<head>
    <title>Panel Administrador</title>
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
    <p>Este es el panel de administrador</p>
    
    <br><br><br>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
        <div class="seleccion">
            <div class="seccion">
                CRUD
                <div class="elemento-seccion">
                    <input type="radio" name="CRUD" id="crear" value="crear">
                    <label for="crear">Crear registro</label>
                </div>
                <div class="elemento-seccion">
                    <input type="radio" name="CRUD" id="recuperar" value="recuperar">
                    <label for="recuperar">Recuperar datos</label>
                </div>
                <div class="elemento-seccion">
                    <input type="radio" name="CRUD" id="actualizar" value="actualizar">
                    <label for="actualizar">Actualizar datos</label>
                </div>
                <div class="elemento-seccion">
                    <input type="radio" name="CRUD" id="eliminar" value="eliminar">
                    <label for="eliminar">Eliminar datos</label>
                </div>
            </div>
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

    <a href="Practica_RA4_RA6_UD3.php"><button>Cerrar sesion</button></a>
</body>
</html>

<?php

if ($_SERVER['REQUEST_METHOD']=="POST") {

    try {
        $form_valido = false;

        $datos_necesarios_categoria = false;
        $datos_necesarios_escuderia = false;
        $datos_necesarios_piloto = false;

        if (isset($_POST['categoria']))               /* ================================> */       $datos_necesarios_categoria = true;
        if (isset($_POST['categoria']) && isset($_POST['escuderia']))      /* ===========> */       $datos_necesarios_escuderia = true;
        if (isset($_POST['categoria']) && isset($_POST['escuderia']) && isset($_POST['escuderia'])) $datos_necesarios_piloto = true;

        // Comprobar que la introduccion de datos ha sido correcta
        if (isset($_POST['CRUD']) && // obligatorio
            isset($_POST['tabla'])) // obligatorio)
            {
            /**
             * ________________________
             * |                      |
             * |       DEBUGGER       |
             * |______________________|
             * 
             */
            echo "Rellenados crud y tabla <br>";

            $crud = $_POST['CRUD']; // recoger seleccion
            $tabla = $_POST['tabla']; // recoger seleccion

            $categoria_filled = false;
            $escuderia_filled = false;
            $piloto_filled = false;

            // en caso de querer introducir en categoria, el campo categoria requerido
            /**
             * HACER IF PARA VER QUE ACCION CRUD HA SELECCIONADO ENGLOBANDO IFs DE CADA TABLA
             */
            if ($crud=='crear') {
                /**
                 * ________________________
                 * |                      |
                 * |       DEBUGGER       |
                 * |______________________|
                 * 
                 */
                echo "El crud es crear <br>";
                if ($tabla=='tabla_categoria' && $datos_necesarios_categoria) {
                    /**
                     * ________________________
                     * |                      |
                     * |       DEBUGGER       |
                     * |______________________|
                     * 
                     */
                    echo "La tabla es categoria <br>";
                    $categoria = $_POST['categoria']; // recoger informacion del formulario
                    /**
                     * _______________________
                     * |                     |
                     * | VALIDAR INFORMACION |
                     * |_____________________|
                     * 
                     */
                    if (trim($categoria)!=="")
                        $categoria_filled = true;
                    /**
                     * __________________________
                     * |                        |
                     * | TRATAMIENTO DE ERRORES |
                     * |________________________|
                     * 
                     */
                    if (!$categoria_filled) {
                        echo "La categoría introducida no es válida.";
                    }
                    /**
                     * ____________________________
                     * |                          |
                     * | INTRODUCCION DE REGISTRO |
                     * |    A TABLA CATEGORIA     |
                     * |__________________________|
                     * 
                     */
                    else // No hay errores
                        $form_valido = true;
                        /**
                         * ________________________
                         * |                      |
                         * |       DEBUGGER       |
                         * |______________________|
                         * 
                         */
                        echo "Introducido: $categoria <br>";
                } 
                // en caso de querer introducir en escuderia, los 2 primeros campos requeridos
                elseif ($tabla=='escuderia' && $datos_necesarios_escuderia) {
                    $categoria = $_POST['categoria']; // recoger informacion del formulario
                    $escuderia = $_POST['escuderia']; // recoger informacion del formulario
                    $form_valido = true;
                    /**
                     * _______________________
                     * |                     |
                     * | VALIDAR INFORMACION |
                     * |_____________________|
                     * 
                     */
                    /**
                     * __________________________
                     * |                        |
                     * | TRATAMIENTO DE ERRORES |
                     * |________________________|
                     * 
                     */
                    /**
                     * ____________________________
                     * |                          |
                     * | INTRODUCCION DE REGISTRO |
                     * |    A TABLA CATEGORIA     |
                     * |__________________________|
                     * 
                     */
                }
                // en caso de querer introducir en piloto, los 3 campos requeridos
                elseif ($tabla=='piloto' && $datos_necesarios_piloto) {
                    $categoria = $_POST['categoria']; // recoger informacion del formulario
                    $escuderia = $_POST['escuderia']; // recoger informacion del formulario
                    $piloto = $_POST['piloto']; // recoger informacion del formulario
                    $form_valido = true;
                    /**
                     * _______________________
                     * |                     |
                     * | VALIDAR INFORMACION |
                     * |_____________________|
                     * 
                     */
                    /**
                     * __________________________
                     * |                        |
                     * | TRATAMIENTO DE ERRORES |
                     * |________________________|
                     * 
                     */
                    /**
                     * ____________________________
                     * |                          |
                     * | INTRODUCCION DE REGISTRO |
                     * |    A TABLA CATEGORIA     |
                     * |__________________________|
                     * 
                     */
                }
            }
        } else {
            echo "<br><br>ERROR: Seleccion operaciones e introduce datos<br><br>";
        }

        

        if ($form_valido) {
            try {
                $cadena_conexion = 'mysql:dbname=BBDD1;host=localhost';
                $usuario = 'PracticaUD3';
                $password = '123456';
                
                // Conexion a BBDD
                $bd = new PDO($cadena_conexion, $usuario, $password);
                echo "<br><br>Conexión a BD correcta<br><br>";
                /**
                 * ________________________
                 * |                      |
                 * |  SELECCION DEL CRUD  |
                 * |______________________|
                 * 
                 *  Cadena de if y elseif que van a filtrar que
                 *  accion del CRUD ha seleccionado
                 *  el usuario en el formulario
                 * 
                 */
                if ($crud == 'crear') {
                    /**
                     * __________________
                     * |                |
                     * |     TABLAS     |
                     * |________________|
                     * 
                     * Cadena de if y elseif que van a
                     * filtrar que tabla ha seleccionado
                     * el usuario en el formulario
                     * 
                     */
                    if ($tabla == 'tabla_categoria') {
                        /**
                         * __________________________
                         * |                        |
                         * | FUNCIONA CORRECTAMENTE |
                         * |________________________|
                         * 
                         */
                        /**
                         * ________________________
                         * |                      |
                         * |  INSERTAR CATEGORIA  |
                         * |______________________|
                         * 
                         * == ACCION ==
                         * El usuario ha seleccionado las
                         * opciones "Crear registro" y
                         * "Categoria".
                         * 
                         * == INTRODUCCION DE DATOS ==
                         * Introducir la categoria
                         * especificada por el usuario
                         * 
                         * == INFORME DE ERRORES ==
                         * Si da algun error al introducir
                         * los datos, informara al
                         * usuario con el problema.
                         * 
                         */
                        try {
                            $preparada = $bd->prepare("INSERT INTO categoria(nombre_categoria) VALUES(?);");
                            $preparada->execute(array($categoria));
                            echo "Caterogía insertada con éxito<br>";
                        }  catch (PDOException $e) {
                            echo 'Error insertando la categoría => ' . $e->getMessage();
                        }

                    } elseif ($tabla == 'tabla_escuderia') {
                        /**
                         * ________________________
                         * |                      |
                         * |  INSERTAR ESCUDERIA  |
                         * |______________________|
                         * 
                         * == ACCION ==
                         * El usuario ha seleccionado las
                         * opciones "Crear registro" y
                         * "Escuderia".
                         * 
                         * == VALIDACIONES MANUALES ==
                         * Comprueba que la categoria exista.
                         * Si no existe pasa a la parte
                         * de informe de errores.
                         * En caso de que exista, guardara
                         * el ID de la categoria en cuestion.
                         * 
                         * == INTRODUCCION DE DATOS ==
                         * Introducir la escuderia y a
                         * que categoria pertenece
                         * especificadas por el usuario
                         * 
                         * == INFORME DE ERRORES ==
                         * Si da algun error al introducir
                         * los datos, informara al
                         * usuario con el problema.
                         * 
                         */
                        try {
                            // RECOGER CATEGORIAS EXISTENTES
                            $sql = 'SELECT * FROM categoria;';
                            $result = $bd->query($sql);
                            // RECORRE LOS RESULTADOS Y SI ENCUENTRA
                            // LA CATEGORIA, GUARDARA SU ID PARA LA
                            // INTRODUCCION EN LA TABLA ESCUDERIA
                            foreach ($result as $row) {
                                if ($row['nombre_categoria'] == $categoria) {
                                    $categoria = $row['id_categoria'];
                                }
                            }
                            
                            //$preparada = $bd->prepare("SELECT * FROM categoria;");
                            //echo "Caterogía insertada con éxito<br>";
                        }  catch (PDOException $e) {
                            echo 'Error insertando la categoría => ' . $e->getMessage();
                        }
                    } elseif ($tabla == 'tabla_piloto') {
                        echo "Crear piloto";
                        // IMPLANTAR CAMPOS PARA RECOGER INFO
                    }
                } elseif ($crud == 'recuperar') {
                    if ($tabla == 'tabla_categoria') {
                        echo "Recuperar categoria";
                        // IMPLANTAR CAMPOS PARA RECOGER INFO
                    } elseif ($tabla == 'tabla_escuderia') {
                        echo "Recuperar escuderia";
                        // IMPLANTAR CAMPOS PARA RECOGER INFO
                    } elseif ($tabla == 'tabla_piloto') {
                        echo "Recuperar piloto";
                        // IMPLANTAR CAMPOS PARA RECOGER INFO
                    }
                } elseif ($crud == 'actualizar') {
                    if ($tabla == 'ctabla_ategoria') {
                        echo "Actualizar categoria";
                        // IMPLANTAR CAMPOS PARA RECOGER INFO
                    } elseif ($tabla == 'tabla_escuderia') {
                        echo "Actualizar escuderia";
                        // IMPLANTAR CAMPOS PARA RECOGER INFO
                    } elseif ($tabla == 'tabla_piloto') {
                        echo "Actualizar piloto";
                        // IMPLANTAR CAMPOS PARA RECOGER INFO
                    }
                } elseif ($crud == 'eliminar') {
                    if ($tabla == 'tabla_categoria') {
                        echo "Eliminar categoria";
                        // IMPLANTAR CAMPOS PARA RECOGER INFO
                    } elseif ($tabla == 'tabla_escuderia') {
                        echo "Eliminar escuderia";
                        // IMPLANTAR CAMPOS PARA RECOGER INFO
                    } elseif ($tabla == 'tabla_piloto') {
                        echo "Eliminar piloto";
                        // IMPLANTAR CAMPOS PARA RECOGER INFO
                    }
                } else {
                    echo "Operación: " . htmlspecialchars($crud) . " | Tabla: " . htmlspecialchars($tabla);
                }

            } catch (PDOException $e) {
		        echo 'Error qal conectar con la BD: ' . $e->getMessage();
            }
            
        }


    } catch (PDOException $e) {
		echo 'Error: ' . $e->getMessage();
	}
}

?>