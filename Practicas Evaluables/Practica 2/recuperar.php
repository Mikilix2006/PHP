<!--
____________________                                      ____________________
|                  |    ████ ████ █   █ ████      ████    |                  |
|    SELECCION     |    █    █  █ █   █ █   █     █  █    |    SELECCION     |
|       CRUD       |    █    ████ █   █ █   █     ████    |       CRUD       |
|    RECUPERAR     |    █    █ █  █   █ █   █     █ █     |    RECUPERAR     |
|__________________|    ████ █  █ █████ ████      █  █    |__________________|


Esta página está dedicada a la RECUPERACIÓN 
de datos de las tablas a elegir
por el usuario en un formulario.

-->

<!DOCTYPE html>
<html>
<head>
    <title>Recuperar datos</title>
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
    <p>Este es el panel de RECUPERACION de datos para administradores</p>
    
    <br><br><br>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
        <div class="seleccion">
            <div class="seccion">
                TABLAS
                <div class="elemento-seccion">
                    <input type="checkbox" name="tabla" id="tabla_categoria" value="tabla_categoria">
                    <label for="tabla_categoria">Categoria</label>
                </div>
                <div class="elemento-seccion">
                    <input type="checkbox" name="tabla" id="tabla_escuderia" value="tabla_escuderia">
                    <label for="tabla_escuderia">Escudería</label>
                </div>
                <div class="elemento-seccion">
                    <input type="checkbox" name="tabla" id="tabla_piloto" value="tabla_piloto">
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

?>