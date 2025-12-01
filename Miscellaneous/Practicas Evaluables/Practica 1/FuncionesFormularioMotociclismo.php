<?php

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
 * con formato de texto en italica y en negrita para
 * la categoria, formato en italica para la escuderia
 * y formato por defecto para el piloto
 */
function imprimirArray($array) {
    echo '<ul>'; // Creacion de lista desordenada
    foreach ($array as $cat => $escuderias) { // Recorrer primer indice
        echo '<li><em><b>'.$cat.'</b></em></li>'; // Impresion de datos en una línea
        echo '<ul>'; // Creacion de sublista desordenada
        foreach ($escuderias as $esc => $pilotos) {
            echo '<li><em>'.$esc.'</em></li>'; // Impresion de datos en una línea
            echo '<ul>'; // Creacion de sublista desordenada
            foreach ($pilotos as $pil)
                echo '<li>'.$pil.'</li>'; // Impresion de datos en una línea
            echo '</ul>';
        }
        echo '</ul>';
    }
    echo '</ul>';
}

/**
 * Crea un array con la categoria, escuderia y
 * piloto (primario: 0 o secundario: 1) a partir
 * de los datos pasados por parametros
 */
function crearArrayPorCategoriaEscuderiaYPiloto($categoria_introducida,$escuderia_introducida,$piloto_introducido) {
    $array = []; // Defino array de uso local
    global $motociclismo; // Hago llamamiento a la matriz global
    foreach ($motociclismo as $cat => $escuderias) { // Recorrer primer indice
        // Al ser por categoria, si existe la categoria, entrara a sus siguientes valores
        if (str_contains(strtolower($cat), $categoria_introducida)) {
            foreach ($motociclismo[$cat] as $esc => $pilotos) { // Recorrer segundo indice
                // Al ser por escuderia tambien, si existe la escuderia, entrara a sus siguientes valores
                if (str_contains(strtolower($esc), $escuderia_introducida)) {
                    foreach ($motociclismo[$cat][$esc] as $pil => $valor) { // Recorrer tercer indice
                        // Al ser por piloto tambien, si existe el piloto, entrara a sus siguientes valores
                        if ($pil==$piloto_introducido) {
                            // Guardo los valores en sus respectivos indices del nuevo array
                            $array[$cat][$esc][$pil]=$valor;
                        }
                    }
                }
            }
        }
    }
    return $array;
}

/** 
 * Crea un array con todos los pilotos (primario: 0 y secundario: 1) de una
 * escuderia y categoria especificadas por parametros
 */
function crearArrayPorCategoriaYEscuderia($categoria_introducida, $escuderia_introducida) {
    $array = []; // Defino array de uso local
    global $motociclismo; // Hago llamamiento a la matriz global
    foreach ($motociclismo as $cat => $escuderias) { // Recorrer primer indice
        // Al ser por categoria, si existe la categoria, entrara a sus siguientes valores
        if (str_contains(strtolower($cat), $categoria_introducida)) {
            foreach ($motociclismo[$cat] as $esc => $pilotos) { // Recorrer segundo indice
                // Al ser por escuderia tambien, si existe la escuderia, entrara a sus siguientes valores
                if (str_contains(strtolower($esc), $escuderia_introducida)) {
                    foreach ($motociclismo[$cat][$esc] as $pil => $valor) { // Recorrer tercer indice
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
 * Crea un array con todas las escuderias
 * a partir de la especificacion de la categoria
 * y el piloto (primario: 0 o secundario: 1) pasados por parametro
 */
function crearArrayPorCategoriaYPiloto($categoria_introducida,$piloto_introducido) {
    $array = []; // Defino array de uso local
    global $motociclismo; // Hago llamamiento a la matriz global
    foreach ($motociclismo as $cat => $escuderias) { // Recorrer primer indice
        // Al ser por categoria, si existe la categoria, entrara a sus siguientes valores
        if (str_contains(strtolower($cat), $categoria_introducida)) {
            foreach ($motociclismo[$cat] as $esc => $pilotos) { // Recorrer segundo indice
                foreach ($motociclismo[$cat][$esc] as $pil => $valor) { // Recorrer tercer indice
                    // Al ser por piloto tambien, si existe el piloto, entrara a sus siguientes valores
                    if ($pil==$piloto_introducido) {
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
 * Crea un array con todas las categorias,
 * escuderias y pilotos a partir de una escuderia
 * y piloto (primario: 0 o secundario: 1) pasadas por parámetro
 */
function crearArrayPorEscuderiaYPiloto($escuderia_introducida,$piloto_introducido) {
    $array = []; // Defino array de uso local
    global $motociclismo; // Hago llamamiento a la matriz global
    foreach ($motociclismo as $cat => $escuderias) { // Recorrer primer indice
        foreach ($motociclismo[$cat] as $esc => $pilotos) { // Recorrer segundo indice
            // Al ser por escuderia, si existe la escuderia, entrara a sus siguientes valores
            if (str_contains(strtolower($esc), $escuderia_introducida)) {
                foreach ($motociclismo[$cat][$esc] as $pil => $valor) { // Recorrer tercer indice
                    // Al ser por piloto tambien, si existe el piloto, entrara a sus siguientes valores
                    if ($pil==$piloto_introducido) {
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
 * Crea un array con la categoria, y todas las
 * escuderias y pilotos (primario: 0 y secundario: 1) a partir de una
 * categoria pasada por parámetro
 */
function crearArrayPorCategoria($categoria_introducida) {
    $array = []; // Defino array de uso local
    global $motociclismo; // Hago llamamiento a la matriz global
    foreach ($motociclismo as $cat => $escuderias) { // Recorrer primer indice
        // Al ser por categoria, si existe la categoria, entrara a sus siguientes valores
        if (str_contains(strtolower($cat), $categoria_introducida)) {
            foreach ($motociclismo[$cat] as $esc => $pilotos) { // Recorrer segundo indice
                foreach ($motociclismo[$cat][$esc] as $pil => $valor) { // Recorrer tercer indice
                    // Guardo los valores en sus respectivos indices del nuevo array
                    $array[$cat][$esc][$pil]=$valor;
                }
            }
        }
    }
    return $array;
}

/** 
 * Crea un array con todas las categorias,
 * escuderias y pilotos (primario: 0 y secundario: 1) a partir de una
 * escuderia pasada por parámetro
 */
function crearArrayPorEscuderia($escuderia_introducida) {
    $array = []; // Defino array de uso local
    global $motociclismo; // Hago llamamiento a la matriz global
    foreach ($motociclismo as $cat => $escuderias) { // Recorrer primer indice
        foreach ($motociclismo[$cat] as $esc => $pilotos) { // Recorrer segundo indice
            // Al ser por escuderia, si existe la escuderia, entrara a sus siguientes valores
            if (str_contains(strtolower($esc), $escuderia_introducida)) {
                foreach ($motociclismo[$cat][$esc] as $pil => $valor) { // Recorrer tercer indice
                    // Guardo los valores en sus respectivos indices del nuevo array
                    $array[$cat][$esc][$pil]=$valor;
                }
            }
        }
    }
    return $array;
}

/** 
 * Crea un array con la categoria
 * y escuderia de un piloto (primario: 0 o secundario: 1)
 * pasado por parámetro
 */
function crearArrayPorPiloto($piloto_introducido) {
    $array = []; // Defino array de uso local
    global $motociclismo; // Hago llamamiento a la matriz global
    foreach ($motociclismo as $cat => $escuderias) { // Recorrer primer indice
        foreach ($motociclismo[$cat] as $esc => $pilotos) { // Recorrer segundo indice
            foreach ($motociclismo[$cat][$esc] as $pil => $valor) { // Recorrer tercer indice
                // Al ser por piloto, si existe el piloto, entrara a sus siguientes valores
                if ($pil==$piloto_introducido) {
                    // Guardo los valores en sus respectivos indices del nuevo array
                    $array[$cat][$esc][$pil]=$valor;
                }
            }
        }
    }
    return $array;
}

/** 
 * Crea y devuelve un array con la categoria, escuderia,
 * piloto (primario: 0 o secundario: 1) y su valor, cuando el contenido coincide
 * con la busqueda introducida por el usuario
 */
function crearArrayPorContenido($contenido_introducido) {
    $array = []; // Defino array de uso local
    global $motociclismo; // Hago llamamiento a la matriz global
    foreach ($motociclismo as $cat => $escuderias) { // Recorrer primer indice
        foreach ($motociclismo[$cat] as $esc => $pilotos) { // Recorrer segundo indice
            foreach ($motociclismo[$cat][$esc] as $pil => $valor) { // Recorrer tercer indice
                // Al ser por contenido, si existe el contenido, guardara la informacion en el array
                if (str_contains(strtolower($valor),$contenido_introducido)) {
                    // Guardo los valores en sus respectivos indices del nuevo array
                    $array[$cat][$esc][$pil]=$valor;
                }
            }
        }
    }
    return $array;
}

/**
 * Recoge el valor de los datos introducidos en el formulario
 */
function recuperarInformacionDeFormulario() {
    // Llamamiento a variables globales
    global $categoria;
    global $escuderia;
    global $piloto;
    global $contenido;
    // Asignación de variables
    $categoria = $_POST['categoria'];
    $escuderia = $_POST['escuderia'];
    $piloto = $_POST['piloto'];
    $contenido = $_POST['contenido'];
}

?>