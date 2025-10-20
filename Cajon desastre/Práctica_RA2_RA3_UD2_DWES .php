<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h1 {
            max-width: fit-content;
            margin: auto;
        }

        form {
            display: flex;
            flex-direction: column;
            width: 300px;
            margin: auto;
        }
        input {
            margin-bottom: 10px;
        }
    </style>
    
</head>
<body>
    <h1>BUSCADOR DE PILOTOS<h1>
    <form method="POST" action="http://localhost/Pr%C3%A1ctica_RA2_RA3_UD2_DWES%20.php">
        <input type ="text" name="categoria" placeholder="Categoría">      
        <input type ="text" name="escuderia" placeholder="Escudería">
        <input type ="number" name="piloto" placeholder="Piloto (1: titular ó 2: secundario)" title="0: Ambos pilotos, 1: Principal, 2: Secundario">
        <input type="submit" value="Buscar">
    </form>
    <h4>
        <?php
        
            // Declaración de matriz tridimensional
            // Motociclismo => Categoría, Escudería, Piloto (Primario, secundario)
            $motociclismo["Moto3"]["Honda"][0]="Tatchakorn Buasri, Tailandia";
            $motociclismo["Moto3"]["Honda"][1]="Taiyo Furusato, Japón";
            $motociclismo["Moto3"]["Ángel Nieto Team"][0]="Máximo Quiles, España";
            $motociclismo["Moto3"]["Ángel Nieto Team"][1]="Dennis Foggia, Italia";
            $motociclismo["Moto3"]["MT Helmets"][0]="Ryusei Yamanaka, Japón";
            $motociclismo["Moto3"]["MT Helmets"][1]="Ángel Piqueras, España";
            $motociclismo["Moto2"]["MT Helmets"][0]="Iván Ortolá, España";
            $motociclismo["Moto2"]["MT Helmets"][1]="Sergio García Dols, España";
            $motociclismo["Moto2"]["Pramac Racing"][0]="Tony Arbolino, Italia";
            $motociclismo["Moto2"]["Pramac Racing"][1]="Izan Guevara, España";
            $motociclismo["Moto2"]["Fantic Racing"][0]="Aron Canet, España";
            $motociclismo["Moto2"]["Fantic Racing"][1]="Barry Baults, Bélgica";
            $motociclismo["MotoGP"]["Ducati Lenovo"][0]="Francesco Bagnaia, Italia";
            $motociclismo["MotoGP"]["Ducati Lenovo"][1]="Marc Marquez, España";
            $motociclismo["MotoGP"]["Yamaha"][0]="Fabio Quartararo, Francia";
            $motociclismo["MotoGP"]["Yamaha"][1]="Álex Rins, España";
            $motociclismo["MotoGP"]["Honda"][0]="Luca Marini, Italia";
            $motociclismo["MotoGP"]["Honda"][1]="Joan Mir, España";

            // Declaración de procedimientos
            /** 
             * Cuando los datos introducidos no coinciden
             * con los indices de la matriz, muestra
             * un mensaje informando al usuario
             */
            function outputSinResultados() {
                echo "No se han encontrado coincidencias.";
            }

            /** 
             * Cuando el usuario se ha saltado campos
             * necesarios de rellenar, le informa
             */
            function mostrarCamposVacios() {
                echo "No se han rellenado campos necesarios.";
            }

            /** 
             * Método que muestra una lista de los pilotos 
             * de una categoría especificada
             */
            function mostrarCategoria($motociclismo,$categoria) {
                if (isset($motociclismo[$categoria])) {
                    echo "Categoría: $categoria".'<br>'.
                        "Escuderías:";
                    echo '<ul>';
                    foreach ($motociclismo[$categoria] as $esc => $pilotos) {
                        echo '<li>'.$esc.'</li>';
                        echo '<ul>';
                        foreach ($pilotos as $pil) {
                            echo '<li>'.$pil.'</li>';
                        }
                        echo '</ul>';
                    }
                    echo '</ul>';
                } else {
                    // No se han encontrado coincidencias
                    outputSinResultados();
                }
            }

            /** 
             * Método que muestra una lista de los pilotos 
             * de una escudería y categoría especificadas
             */
            function mostrarEscuderia($motociclismo,$categoria,$escuderia) {
                if (isset($motociclismo[$categoria][$escuderia])) {
                    echo "Categoría: $categoria".'<br>'.
                        "Escudería: $escuderia".'<br>'.
                        "Pilotos:";
                        echo '<ul>';
                        foreach ($motociclismo[$categoria][$escuderia] as $pil) {
                            echo '<li>'.$pil.'</li>';
                        }
                        echo '</ul>';
                } else {
                    // No se han encontrado coincidencias
                    outputSinResultados();
                }
            }

            /** 
             * Método que muestra una lista de los pilotos 
             * de una escudería, categoría y piloto especificados
             */
            function mostrarPiloto($motociclismo,$categoria,$escuderia,$piloto) {
                if (isset($motociclismo[$categoria][$escuderia][$piloto])) {
                    echo "Categoría: $categoria".'<br>'.
                        "Escudería: $escuderia".'<br>'.
                        "Piloto: " . $motociclismo[$categoria][$escuderia][$piloto];
                } else {
                    // No se han encontrado coincidencias
                    outputSinResultados();
                }
            }

            // Asignación de variables
            $categoria = $_POST['categoria'];
            $escuderia = $_POST['escuderia'];
            $piloto = $_POST['piloto'];
            $categoria_filled = false;
            $escuderia_filled = false;
            $piloto_filled = false;

            // Comprobar qué variables están rellenas
            if (trim($categoria)!=="")
                $categoria_filled = true;

            if (trim($escuderia)!=="")
                $escuderia_filled = true;

            if ($piloto==="1"||$piloto==="2")
                $piloto_filled = true;

            /*
            // Formateo de contenidos
            if ($categoria_filled) {
                strtolower($categoria);
                trim($categoria);
            }

            if ($escuderia_filled) {
                strtolower($escuderia);
                trim($escuderia);
            }
            */

            // Procesamiento de búsqueda
            if ($categoria_filled) {
                if ($escuderia_filled) {
                    if ($piloto_filled) {
                        // Todos los campos están rellenos
                        mostrarPiloto($motociclismo,$categoria,$escuderia,$piloto);
                    } else {
                        // Están rellenos el primer y segundo campo
                        mostrarEscuderia($motociclismo,$categoria,$escuderia);
                    }
                } else {
                    // Está relleno el primer campo
                    mostrarCategoria($motociclismo,$categoria);
                }
            } else {
                // No hay campos rellenos
                mostrarCamposVacios();
            }
            
            // Debug
            /*
            echo var_dump($categoria_filled).'<br>'.$categoria.'<br>';
            echo var_dump($escuderia_filled).'<br>'.$escuderia.'<br>';
            echo var_dump($piloto_filled).'<br>'.$piloto.'<br>';
            */

        ?>
    </h4>
</body>
</html>