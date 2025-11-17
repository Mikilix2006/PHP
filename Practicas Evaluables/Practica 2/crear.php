
____________________    #### #### #   # ####      ####    ____________________
|                  |    #    #  # #   # #   #     #       |                  |
|    SELECCION     |    #    #### #   # #   #     #       |    SELECCION     |
|    CRUD CREAR    |    #    # #  #   # #   #     #       |    CRUD CREAR    |
|__________________|    #### #  # ##### ####      ####    |__________________|


Esta página está dedicada a la creacion 
de un registro en una tabla a elegir
por el usuario en un formulario.

Además, se deberá especificar
qué datos se quieren introducir.


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
    <p>Este es el panel de creacion de registro para administradores</p>
    
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

        $crud = $_POST['CRUD']; // recoger seleccion
        $tabla = $_POST['tabla']; // recoger seleccion
        // Si cualquiera de las opciones disponibles es verdadera
        // quiere decir que el formulario es valido
        if ($datos_necesarios_categoria ||
            $datos_necesarios_escuderia ||
            $datos_necesarios_piloto) {
                $form_valido = true;
            } else {
                echo "Rellena todos los datos necesarios del formulario.";
            }
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
             * __________________
             * |                | ##### #### ####  #     ####     ####
             * |    CREAR EN    |   #   #  # #  #  #     #  #     #   
             * |     TABLA      |   #   #### ##### #     ####     #   
             * |    CATEGORIA   |   #   #  # #   # #     #  #     #   
             * |________________|   #   #  # ##### ##### #  #     ####
             * 
             */
            if ($tabla == 'tabla_categoria' && $datos_necesarios_categoria) {
                $categoria = $_POST['categoria']; // Recoger informacion del formulario
                /**
                 * _______________________
                 * |                     |
                 * | VALIDAR INFORMACION |
                 * |    DE CATEGORIA     |
                 * |_____________________|
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
                    echo "La categoría introducida no es válida.";
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
                        echo "Caterogía < $categoria > insertada con éxito<br>";
                    }  catch (PDOException $e) {
                        echo 'Error insertando la categoría => ' . $e->getMessage();
                    }
                }
            /**
             * __________________
             * |                | ##### #### ####  #     ####     ####
             * |    CREAR EN    |   #   #  # #  #  #     #  #     #   
             * |     TABLA      |   #   #### ##### #     ####     ### 
             * |    ESCUDERIA   |   #   #  # #   # #     #  #     #   
             * |________________|   #   #  # ##### ##### #  #     ####
             * 
             */
            } elseif ($tabla == 'tabla_escuderia' && $datos_necesarios_escuderia) {
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
                }
            /**
             * __________________
             * |                | ##### #### ####  #     ####     ####
             * |    CREAR EN    |   #   #  # #  #  #     #  #     #  #
             * |     TABLA      |   #   #### ##### #     ####     ####   
             * |     PILOTO     |   #   #  # #   # #     #  #     #   
             * |________________|   #   #  # ##### ##### #  #     #
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
                 */
                /**
                 * __________________________
                 * |                        |
                 * | TRATAMIENTO DE ERRORES |
                 * |    DE INSERCION DE     |
                 * |         PILOTO         |   
                 * |________________________|
                 * 
                 */
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
                 * == INTRODUCCION DE DATOS ==
                 * Introducir el piloto y a
                 * que escuderia y categoria pertenece
                 * especificadas por el usuario
                 * 
                 * == INFORME DE ERRORES ==
                 * Si da algun error al introducir
                 * los datos, informara al
                 * usuario con el problema.
                 * 
                 */
                }
        } catch (PDOException $e) {
            echo 'Error al conectar con la BD: ' . $e->getMessage();
        }
        
    }
}

?>