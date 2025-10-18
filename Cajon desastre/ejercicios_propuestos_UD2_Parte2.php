<?php

/**
 * 3. Implementa una función que reciba un número de 
 * días y devuelva el número de segundos correspondientes
 * a esos días. A continuación llama a la función con un 
 * número de días concreto y visualiza lo que devuelve.
 */

/**
 * Convierte un número de días ($num_dias) a segundos.
 * 
 * @param num_dias: numero de dias a transformar en segundos
 * @return Número de segundos equivalentes a $num_dias
 */
function daytosecs($num_dias) {
    // Nº segs = Nº dias * 24h * 60min * 60seg
    if ($num_dias >= 0) { // Filtro: no puede ser negativo
        if (is_string($num_dias)) // Filtra si es un string
            if (is_numeric($num_dias)) // Filtra si son letras o numeros
                if ((int) $num_dias == $num_dias) // Clasifica ente entero o double
                    return (int) $num_dias * 24 * 60 ** 2;
                else 
                    return (double) $num_dias * 24 * 60 ** 2;
            else 
                return "Parámetro inválido: ".$num_dias; // El parametro contiene letras
        if (is_int($num_dias)) // Filtra si es un int
            return $num_dias * 24 * 60 ** 2;
        if (is_double($num_dias)) // Filtra si es un double
            return (double) $num_dias * 24 * 60 ** 2;
    }
    return "Parámetro inválido: ".$num_dias; // El parametro es negativo
}

echo daytosecs("3")."\n";
echo daytosecs("1.4")."\n";
echo daytosecs("jsdg")."\n";
echo daytosecs("ndgj9834")."\n";
echo daytosecs(4)."\n";
echo daytosecs(1.4)."\n";
echo daytosecs(-1)."\n";
echo daytosecs(0)."\n";

?>
