<!--

Aplicación desarrollada con PHP, HTML5 y CSS3
PHP: Inclusion de archivos externos, uso de métodos, uso de variables en ámbitos global y local.
HTML5: Uso de formularios con metodos POST.
CS3: Uso de estilos y clases, uso de archivos externos.
XAMPP: Uso de programa XAMPP para ejecutar los PHP realizados en el buscador.

-->
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


// Importaciones
include 'FuncionesFormularioMotociclismo.php';
include 'matrizMotos.php';


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
if ($categoria_filled && $escuderia_filled && $piloto_filled) {
    /* 
        "tipo_busqueda" indica 1 true o 0 false
        los 0 a la izquierda no cuentan a si que se omiten
        primer bit: busqueda por contenido
        segundo bit: busqueda por categoria
        tercer bit: busqueda por escuderia
        cuarto bit: busqueda por piloto
    */
    $busqueda = array(
        "tipo_busqueda" => 111,
        "categoria" => $categoria,
        "escuderia" => $escuderia,
        "piloto" => $piloto
    );
}

// 2 campos rellenos
// Busqueda por categoria y escuderia
if ($categoria_filled && $escuderia_filled && !$piloto_filled) {
    /* 
        "tipo_busqueda" indica 1 true o 0 false
        los 0 a la izquierda no cuentan a si que se omiten
        primer bit: busqueda por contenido
        segundo bit: busqueda por categoria
        tercer bit: busqueda por escuderia
        cuarto bit: busqueda por piloto
    */
    $busqueda = array(
        "tipo_busqueda" => 110,
        "categoria" => $categoria,
        "escuderia" => $escuderia
    );
}
// Busqueda por categoria y piloto
if ($categoria_filled && !$escuderia_filled && $piloto_filled) {
    /* 
        "tipo_busqueda" indica 1 true o 0 false
        los 0 a la izquierda no cuentan a si que se omiten
        primer bit: busqueda por contenido
        segundo bit: busqueda por categoria
        tercer bit: busqueda por escuderia
        cuarto bit: busqueda por piloto
    */
    $busqueda = array(
        "tipo_busqueda" => 101,
        "categoria" => $categoria,
        "piloto" => $piloto
    );
}
// Busqueda por escuderia y piloto
if (!$categoria_filled && $escuderia_filled && $piloto_filled) {
    /* 
        "tipo_busqueda" indica 1 true o 0 false
        los 0 a la izquierda no cuentan a si que se omiten
        primer bit: busqueda por contenido
        segundo bit: busqueda por categoria
        tercer bit: busqueda por escuderia
        cuarto bit: busqueda por piloto
    */
    $busqueda = array(
        "tipo_busqueda" => 11,
        "escuderia" => $escuderia,
        "piloto" => $piloto
    );
}

// 1 campo relleno
// Busqueda por categoria
if ($categoria_filled && !$escuderia_filled && !$piloto_filled) {
    /* 
        "tipo_busqueda" indica 1 true o 0 false
        los 0 a la izquierda no cuentan a si que se omiten
        primer bit: busqueda por contenido
        segundo bit: busqueda por categoria
        tercer bit: busqueda por escuderia
        cuarto bit: busqueda por piloto
    */
    $busqueda = array(
        "tipo_busqueda" => 100,
        "categoria" => $categoria
    );
}
// Busqueda por escuderia
if (!$categoria_filled && $escuderia_filled && !$piloto_filled) {
    /* 
        "tipo_busqueda" indica 1 true o 0 false
        los 0 a la izquierda no cuentan a si que se omiten
        primer bit: busqueda por contenido
        segundo bit: busqueda por categoria
        tercer bit: busqueda por escuderia
        cuarto bit: busqueda por piloto
    */
    $busqueda = array(
        "tipo_busqueda" => 10,
        "escuderia" => $escuderia
    );
}
// Busqueda por piloto
if (!$categoria_filled && !$escuderia_filled && $piloto_filled) {
    /* 
        "tipo_busqueda" indica 1 true o 0 false
        los 0 a la izquierda no cuentan a si que se omiten
        primer bit: busqueda por contenido
        segundo bit: busqueda por categoria
        tercer bit: busqueda por escuderia
        cuarto bit: busqueda por piloto
    */
    $busqueda = array(
        "tipo_busqueda" => 1,
        "piloto" => $piloto
    );
}

// 0 campos rellenos
if (!$categoria_filled && !$escuderia_filled && !$piloto_filled && !$contenido_filled) {
    /* 
        "tipo_busqueda" indica 1 true o 0 false
        los 0 a la izquierda no cuentan a si que se omiten
        primer bit: busqueda por contenido
        segundo bit: busqueda por categoria
        tercer bit: busqueda por escuderia
        cuarto bit: busqueda por piloto
    */
    $busqueda = array(
        "tipo_busqueda" => 0
    );
}

// Busqueda por contenido
if ($contenido_filled) {
    /* 
        "tipo_busqueda" indica 1 true o 0 false
        los 0 a la izquierda no cuentan a si que se omiten
        primer bit: busqueda por contenido
        segundo bit: busqueda por categoria
        tercer bit: busqueda por escuderia
        cuarto bit: busqueda por piloto
    */
    $busqueda = array(
        "tipo_busqueda" => 1000,
        "contenido" => $contenido
    );
}
/*
// Impresion del array
if (count($array)<1) {
    // Sin coincidencias, array vacio
    outputSinResultados();
} else {
    // Array lleno
    echo '<h3>Resultados de búsqueda:</h3>';
    imprimirArray($array);
}
*/

$datos = array(
    "matriz" => $motociclismo,
    "busqueda" => $busqueda
);
$json = json_encode($datos);
echo $json;

?>