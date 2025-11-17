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
            margin-top: 200px;
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
        <input type ="text" name="x" placeholder="Categoría">      
        <input type ="text" name="y" placeholder="Escudería">
        <input type ="number" name="z" placeholder="Piloto (1: titular ó 2: secundario)" title="0: Default">
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
            function outputSinResultados() {
                echo "No se han encontrado coincidencias.";
            }

            // Asignación de variables
            $x = $_POST['x'];
            $y = $_POST['y'];
            $z = $_POST['z'];
            $categoria_filled = false;
            $escuderia_filled = false;
            $piloto_filled = false;

            // Comprobaciones de variables
            if (trim($x)!=="")
                $categoria_filled = true;

            if (trim($y)!=="")
                $escuderia_filled = true;

            if ($z==="1"||$z==="2")
                $piloto_filled = true;

            // Procesamiento de búsqueda

            
            // Debug
            echo var_dump($categoria_filled).'<br>'.$x.'<br>';
            echo var_dump($escuderia_filled).'<br>'.$y.'<br>';
            echo var_dump($piloto_filled).'<br>'.$z.'<br>';


        ?>
    </h4>
</body>
</html>