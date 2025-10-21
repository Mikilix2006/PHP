<!DOCTYPE html>
<!--

Aplicación desarrollada con PHP, HTML5 y CSS3

-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h1, h3 {
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
        .formularios {
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
            margin-top: 50px
        }
    </style>
    
</head>
<body>
    <h1>BUSCADOR DE PILOTOS</h1>
    <div class="formularios">
        <div>
            <h3>Por una combinación de sus claves</h3>
            <form method="POST" action="http://localhost/Practica_RA2_RA3_UD2_DWES%20.php">
                <input type ="text" name="categoria" placeholder="Categoría">      
                <input type ="text" name="escuderia" placeholder="Escudería">
                <input type ="number" name="piloto" placeholder="Piloto (1: titular ó 2: secundario)" title="0: Ambos pilotos, 1: Principal, 2: Secundario">
                <input type="submit" value="Buscar">
            </form>
        </div>
        <div>
            <h3>Por su contenido</h3>
            <form method="POST" action="http://localhost/Practica_RA2_RA3_UD2_DWES%20.php">
                <input type ="text" name="contenido" placeholder="Contenido">      
                <input type="submit" value="Buscar">
            </form>
        </div>
    </div>
    <h4>
        <?php

            // Declaración de matriz tridimensional
            // Motociclismo => Categoría, Escudería, Piloto (Primario, secundario)
            $motociclismo["MotoGP"]["Ducati Lenovo"][0]="Francesco Bagnaia, Italia";
            $motociclismo["MotoGP"]["Ducati Lenovo"][1]="Marc Marquez, España";
            $motociclismo["MotoGP"]["Yamaha"][0]="Fabio Quartararo, Francia";
            $motociclismo["MotoGP"]["Yamaha"][1]="Álex Rins, España";
            $motociclismo["MotoGP"]["Honda"][0]="Luca Marini, Italia";
            $motociclismo["MotoGP"]["Honda"][1]="Joan Mir, España";
            $motociclismo["Moto2"]["MT Helmets"][0]="Iván Ortolá, España";
            $motociclismo["Moto2"]["MT Helmets"][1]="Sergio García Dols, España";
            $motociclismo["Moto2"]["Pramac Racing"][0]="Tony Arbolino, Italia";
            $motociclismo["Moto2"]["Pramac Racing"][1]="Izan Guevara, España";
            $motociclismo["Moto2"]["Fantic Racing"][0]="Aron Canet, España";
            $motociclismo["Moto2"]["Fantic Racing"][1]="Barry Baults, Bélgica";
            $motociclismo["Moto3"]["Honda"][0]="Tatchakorn Buasri, Tailandia";
            $motociclismo["Moto3"]["Honda"][1]="Taiyo Furusato, Japón";
            $motociclismo["Moto3"]["Ángel Nieto Team"][0]="Máximo Quiles, España";
            $motociclismo["Moto3"]["Ángel Nieto Team"][1]="Dennis Foggia, Italia";
            $motociclismo["Moto3"]["MT Helmets"][0]="Ryusei Yamanaka, Japón";
            $motociclismo["Moto3"]["MT Helmets"][1]="Ángel Piqueras, España";




            // Declaración de procedimientos
            /** 
             * Cuando los datos introducidos no coinciden
             * con los indices de la matriz, muestra
             * un mensaje informando al usuario
             */
            function outputSinResultados() {echo "No se han encontrado coincidencias.";}

            /** 
             * Cuando el usuario se ha saltado campos
             * necesarios de rellenar, le informa
             */
            function mostrarCamposVacios() {echo "No se han rellenado campos necesarios.";}

            /**
             * Imprime cualquier array tridimensional
             */
            function imprimirArray($array) {
                echo '<ul>';
                foreach ($array as $cat => $escuderias) {
                    echo '<li>'.$cat.'</li>';
                    echo '<ul>';
                    foreach ($escuderias as $esc => $pilotos) {
                        echo '<li>'.$esc.'</li>';
                        echo '<ul>';
                        foreach ($pilotos as $pil)
                            echo '<li>'.$pil.'</li>';
                        echo '</ul>';
                    }
                    echo '</ul>';
                }
                echo '</ul>';
            }

            /** 
             * 
             */
            function crearArrayPorCategoriaYEscuderia($categoria_introducida, $escuderia_introducida) {
                $array = []; // Defino array
                global $motociclismo;
                foreach ($motociclismo as $cat => $escuderias) { // Me meto en el primer índice
                    // Al ser por categoria, si existe la categoria, entrara a sus siguientes valores
                    if (str_contains(strtolower($cat), $categoria_introducida)) {
                        foreach ($motociclismo[$cat] as $esc => $pilotos) { // Me meto en el segundo índice
                            // Al ser por escuderia tambien, si existe la escuderia, entrara a sus siguientes valores
                            if (str_contains(strtolower($esc), $escuderia_introducida)) {
                                foreach ($motociclismo[$cat][$esc] as $pil => $valor) { // Me meto en el tercer índice
                                    // Guardo los valores en sus respectivos indices del nuevo array
                                    $array[$cat][$esc][$pil]=$valor;
                                }
                            }
                        }
                    }
                }
                return $array;
            }

            function crearArrayPorCategoriaYPiloto($categoria_introducida,$piloto_introducido) {
                $array = []; // Defino array
                global $motociclismo;
                foreach ($motociclismo as $cat => $escuderias) { // Me meto en el primer índice
                    // Al ser por categoria, si existe la categoria, entrara a sus siguientes valores
                    if (str_contains(strtolower($cat), $categoria_introducida)) {
                        foreach ($motociclismo[$cat] as $esc => $pilotos) { // Me meto en el segundo índice
                            foreach ($motociclismo[$cat][$esc] as $pil => $valor) { // Me meto en el tercer índice
                                // Al ser por piloto tambien, si existe el piloto, entrara a sus siguientes valores
                                if (str_contains(strtolower($pil), $piloto_introducido)) {
                                    // Guardo los valores en sus respectivos indices del nuevo array
                                    $array[$cat][$esc][$pil]=$valor;
                                }
                            }
                        }
                    }
                }
                return $array;
            }

            /** 
             * Crea un array con todos los pilotos
             * y escuderias a partir de una
             * categoria pasada por parámetro
             */
            function crearArrayPorCategoria($categoria_introducida) {
                $array = []; // Defino array
                global $motociclismo;
                foreach ($motociclismo as $cat => $escuderias) { // Me meto en el primer índice
                    // Al ser por categoria, si existe la categoria, entrara a sus siguientes valores
                    if (str_contains(strtolower($cat), $categoria_introducida)) {
                        foreach ($motociclismo[$cat] as $esc => $pilotos) { // Me meto en el segundo índice
                            foreach ($motociclismo[$cat][$esc] as $pil => $valor) { // Me meto en el tercer índice
                                // Guardo los valores en sus respectivos indices del nuevo array
                                $array[$cat][$esc][$pil]=$valor;
                            }
                        }
                    }
                }
                return $array;
            }

            /** 
             * Crea un array con todos los pilotos
             * y escuderias a partir de una
             * categoria pasada por parámetro
             */
            function crearArrayPorEscuderia($escuderia_introducida) {
                $array = []; // Defino array
                global $motociclismo;
                foreach ($motociclismo as $cat => $escuderias) { // Me meto en el primer índice
                    foreach ($motociclismo[$cat] as $esc => $pilotos) { // Me meto en el segundo índice
                        // Al ser por escuderia, si existe la escuderia, entrara a sus siguientes valores
                        if (str_contains(strtolower($esc), $escuderia_introducida)) {
                            foreach ($motociclismo[$cat][$esc] as $pil => $valor) { // Me meto en el tercer índice
                                // Guardo los valores en sus respectivos indices del nuevo array
                                $array[$cat][$esc][$pil]=$valor;
                            }
                        }
                    }
                }
                return $array;
            }

            /** 
             * Crea un array con todos los pilotos
             * y escuderias a partir de una
             * categoria pasada por parámetro
             */
            function crearArrayPorPiloto($piloto_introducido) {
                $array = []; // Defino array
                global $motociclismo;
                foreach ($motociclismo as $cat => $escuderias) // Me meto en el primer índice
                    foreach ($motociclismo[$cat] as $esc => $pilotos) // Me meto en el segundo índice
                            foreach ($motociclismo[$cat][$esc] as $pil => $valor) // Me meto en el tercer índice
                                // Al ser por piloto, si existe el piloto, entrara a sus siguientes valores
                                if (str_contains(strtolower($pil), $piloto_introducido))
                                    // Guardo los valores en sus respectivos indices del nuevo array
                                    $array[$cat][$esc][$pil]=$valor;
                return $array;
            }

            /** 
             * Crea un array con todos los pilotos
             * y escuderias a partir de una
             * categoria pasada por parámetro
             */
            function crearArrayPorContenido($contenido_introducido) {
                $string; // Defino array
                global $motociclismo;
                foreach ($motociclismo as $cat => $escuderias) // Me meto en el primer índice
                    foreach ($motociclismo[$cat] as $esc => $pilotos) // Me meto en el segundo índice
                            foreach ($motociclismo[$cat][$esc] as $pil => $valor) // Me meto en el tercer índice
                                // Al ser por piloto, si existe el piloto, entrara a sus siguientes valores
                                if (str_contains(strtolower($pil), $piloto_introducido))
                                    // Guardo los valores en sus respectivos indices del nuevo array
                                    $array[$cat][$esc][$pil]=$valor;
                return $string;
            }




            // Asignación de variables
            $categoria = $_POST['categoria'];
            $escuderia = $_POST['escuderia'];
            $piloto = $_POST['piloto'];
            $valor = $_POST['contenido'];
            $categoria_filled = false;
            $escuderia_filled = false;
            $piloto_filled = false;
            $contenido_filled = false;




            // Comprobar qué variables están rellenas
            if (trim($categoria)!=="")
                $categoria_filled = true;

            if (trim($escuderia)!=="")
                $escuderia_filled = true;

            if ($piloto==="1"||$piloto==="2")
                $piloto_filled = true;




            // Formateo de cadenas para mejor busqueda
            if ($categoria_filled) {
                trim($categoria);
                strtolower($categoria);
            }
            if ($escuderia_filled) {
                trim($escuderia);
                strtolower($escuderia);
            }
            // Ajuste de variable piloto para que 
            // coincida con el indice del la matriz
            if ($piloto_filled) {
                $piloto_filled -= 1;
            }




            // Procesamiento de búsqueda
            // 3 campos rellenos
            if ($categoria_filled && $escuderia_filled && $piloto_filled) {}

            // 2 campos rellenos
            // Busqueda por categoria y escuderia
            if ($categoria_filled && $escuderia_filled && !$piloto_filled) {
                $array=crearArrayPorCategoriaYEscuderia($categoria,$escuderia);
            }
            // Busqueda por categoria y piloto
            if ($categoria_filled && !$escuderia_filled && $piloto_filled) {
                $array=crearArrayPorCategoriaYPiloto($categoria,$piloto);
            }
            // Busqueda por escuderia y piloto
            if (!$categoria_filled && $escuderia_filled && $piloto_filled) {}

            // 1 campo relleno
            // Busqueda por categoria
            if ($categoria_filled && !$escuderia_filled && !$piloto_filled)
                $array=crearArrayPorCategoria($categoria);
            // Busqueda por escuderia
            if (!$categoria_filled && $escuderia_filled && !$piloto_filled)
                $array=crearArrayPorEscuderia($escuderia);
            // Busqueda por piloto
            if (!$categoria_filled && !$escuderia_filled && $piloto_filled)
                $array=crearArrayPorPiloto($piloto);

            // 0 campos rellenos
            if (!$categoria_filled && !$escuderia_filled && !$piloto_filled)
                mostrarCamposVacios();

            // Busqueda por contenido
            if ($contenido_filled) {}

            // Impresion del array
            imprimirArray($array);
            
            
            
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