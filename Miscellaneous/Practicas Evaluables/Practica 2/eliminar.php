<!--
____________________                                       ____________________
|                  |    ████ ████ █   █ ████      ████     |                  |
|    SELECCION     |    █    █  █ █   █ █   █     █   █    |    SELECCION     |
|       CRUD       |    █    ████ █   █ █   █     █   █    |       CRUD       |
|     ELIMINAR     |    █    █ █  █   █ █   █     █   █    |     ELIMINAR     |
|__________________|    ████ █  █ █████ ████      ████     |__________________|


Esta página está dedicada a la ACTUALIZACIÓN 
de datos de las tablas a elegir
por el usuario en un formulario.

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
    <p>Este es el panel de ELIMINACION de datos para administradores</p>
    
    <br><br><br>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
        <div class="seleccion">
            <div class="seccion">
                TABLAS
                <div class="elemento-seccion">
                    <input type="radio" name="tabla" id="tabla_categoria" value="tabla_categoria" <?php if(isset($_POST['tabla']) && $_POST['tabla'] == 'tabla_categoria') { echo 'checked'; } ?>>
                    <label for="tabla_categoria">Categoria</label>
                </div>
                <div class="elemento-seccion">
                    <input type="radio" name="tabla" id="tabla_escuderia" value="tabla_escuderia" <?php if(isset($_POST['tabla']) && $_POST['tabla'] == 'tabla_escuderia') { echo 'checked'; } ?>>
                    <label for="tabla_escuderia">Escudería</label>
                </div>
                <div class="elemento-seccion">
                    <input type="radio" name="tabla" id="tabla_piloto" value="tabla_piloto" <?php if(isset($_POST['tabla']) && $_POST['tabla'] == 'tabla_piloto') { echo 'checked'; } ?>>
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
             * |    ELIMINAR    |   █   █  █ █  █  █     █  █     █   
             * |     TABLA      |   █   ████ █████ █     ████     █   
             * |    CATEGORIA   |   █   █  █ █   █ █     █  █     █   
             * |________________|   █   █  █ █████ █████ █  █     ████
             * 
             */
            if ($tabla == 'tabla_categoria') {
                require "eliminarCategoria.php";
            /**
             * __________________
             * |                | █████ ████ ████  █     ████     ████
             * |    ELIMINAR    |   █   █  █ █  █  █     █  █     █   
             * |     TABLA      |   █   ████ █████ █     ████     ███ 
             * |    ESCUDERIA   |   █   █  █ █   █ █     █  █     █   
             * |________________|   █   █  █ █████ █████ █  █     ████
             * 
             */
            } elseif ($tabla == 'tabla_escuderia') {
                require "eliminarEscuderia.php";
            /**
             * __________________
             * |                | █████ ████ ████  █     ████     ████
             * |    ELIMINAR    |   █   █  █ █  █  █     █  █     █  █
             * |     TABLA      |   █   ████ █████ █     ████     ████   
             * |     PILOTO     |   █   █  █ █   █ █     █  █     █   
             * |________________|   █   █  █ █████ █████ █  █     █   
             * 
             */
            } elseif ($tabla == 'tabla_piloto') {
                require "eliminarPiloto.php";
            }
        } catch (PDOException $e) {
            echo 'Error al conectar con la BD: ' . $e->getMessage();
        }
        
    } else {
        echo "<br><br>Los datos del formulario no son válidos.";
    }
}

?>