<!DOCTYPE html>
<!--

Aplicación desarrollada con PHP, HTML5 y CSS3
PHP: Inclusion de archivos externos, uso de métodos, uso de variables en ámbitos global y local.
HTML5: Uso de formularios con metodos POST.
CS3: Uso de estilos y clases, uso de archivos externos.
XAMPP: Uso de programa XAMPP para ejecutar los PHP realizados en el buscador.

-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilosFormularioMotociclismo.css">
</head>
<body>
    <h1>BUSCADOR DE PILOTOS</h1>
    <div class="formularios">
        <div>
            <h3>Por sus claves</h3>
            <form method="POST" action="http://localhost/Practica_RA2_RA3_UD2_DWES.php">
                <input type ="text" name="categoria" placeholder="Categoría"/>      
                <input type ="text" name="escuderia" placeholder="Escudería"/>
                <input type ="number" name="piloto" placeholder="Piloto (1: titular ó 2: secundario)" title="0: Ambos pilotos, 1: Principal, 2: Secundario"/>
                <input type="submit" value="Buscar"/>
            </form>
        </div>
        <div>
            <h3>Por su contenido</h3>
            <form method="POST" action="http://localhost/Practica_RA2_RA3_UD2_DWES.php">
                <input type ="text" name="contenido" placeholder="Contenido"/>      
                <input type="submit" value="Buscar"/>
            </form>
        </div>
    </div>
    <div class="php-output">
        <?php

            // Declaración de variables
            $categoria;
            $escuderia;
            $piloto;
            $contenido;
            $categoria_filled = false;
            $escuderia_filled = false;
            $piloto_filled = false;
            $contenido_filled = false;


            // Declaración de procedimientos
            include 'FuncionesFormularioMotociclismo.php';
            

            // Recoge los datos introducidos por el usuario
            recuperarInformacionDeFormulario();


            // Comprobar qué variables están rellenas
            if (trim($categoria)!=="")
                $categoria_filled = true;

            if (trim($escuderia)!=="")
                $escuderia_filled = true;

            if ($piloto==="1"||$piloto==="2")
                $piloto_filled = true;

            if (trim($contenido)!=="")
                $contenido_filled = true;


            // Formateo de cadenas para mejor busqueda
            // Se retiran espacios en blanco por delante y por detras
            // Se pone la cadena en minúsculas
            // Formateo de categoría
            if ($categoria_filled)
                $categoria=strtolower(trim($categoria));
            // Formateo de escuderia
            if ($escuderia_filled)
                $escuderia=strtolower(trim($escuderia));
            // Formateo de contenido
            if ($contenido_filled)
                $contenido=strtolower(trim($contenido));
            // Ajuste de variable piloto para que 
            // coincida con el indice del la matriz
            if ($piloto_filled)
                $piloto -= 1;
            

            // Procesamiento de búsqueda
            // 3 campos rellenos
            if ($categoria_filled && $escuderia_filled && $piloto_filled)
                $array=crearArrayPorCategoriaEscuderiaYPiloto($categoria,$escuderia,$piloto);

            // 2 campos rellenos
            // Busqueda por categoria y escuderia
            if ($categoria_filled && $escuderia_filled && !$piloto_filled)
                $array=crearArrayPorCategoriaYEscuderia($categoria,$escuderia);
            // Busqueda por categoria y piloto
            if ($categoria_filled && !$escuderia_filled && $piloto_filled)
                $array=crearArrayPorCategoriaYPiloto($categoria,$piloto);
            // Busqueda por escuderia y piloto
            if (!$categoria_filled && $escuderia_filled && $piloto_filled)
                $array=crearArrayPorEscuderiaYPiloto($escuderia,$piloto);

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
            if (!$categoria_filled && !$escuderia_filled && !$piloto_filled && !$contenido_filled)
                mostrarCamposVacios();

            // Busqueda por contenido
            if ($contenido_filled)
                $array=crearArrayPorContenido($contenido);

            // Impresion del array
            if (count($array)<1) {
                // Sin coincidencias, array vacio
                outputSinResultados();
            } else {
                // Array lleno
                echo '<h3>Resultados de búsqueda:</h3>';
                imprimirArray($array);
            }
        ?>
    </div>
</body>
</html>