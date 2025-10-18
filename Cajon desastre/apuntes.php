<?php

// APUNTES

/* 
 * Arrays
 */
 
$meses_anio=['Enero','Febrero','Marzo',
			'Abril','Mayo','Junio',
			'Julio','Agosto','Septiembre',
			'Octubre','Noviembre','Diciembre'];
echo "<u><b>Visualización de array con 'print_r()'</b></u>:<br>";
print_r($meses_anio);

echo '<br><br><br>';

/* 
 * var_dump(mixed) 
 */
 
$dumpear="Me van a dumpear";
$dumpear2=array(1,2,array("a","b","c"));

// Si no quieres que el valor sea sustituido 
// por la variable, utilizas comillas simples

echo "<u><b>Visualización de var_dump()</b></u>:<br>";
echo '$dumpear tiene tipo y longitud --> ';
var_dump($dumpear);
echo '<br>';
echo '$dumpear2 tiene tipo y longitud --> ';
echo var_dump($dumpear2).'<br>';
echo var_dump((bool) NULL);

echo '<br><br><br>';

/*
 * Igualdad o Identidad
 */
 
 echo "<u><b>Diferencia entre igualdad e identidad</b></u>:<br>";
$a = 3;
$b = "3";
echo var_dump($a);
if ($a == $b){
	echo "Son iguales <br>";
}else{
	echo "No son iguales <br>";
}
if ($a === $b){
	echo "Son idénticos <br>";
}else{
	echo "No son idénticos <br>";
}

echo '<br><br><br>';

/*
 * Tipos numéricos
 */

echo "<u><b>Tipos numéricos</b></u>:<br>";
echo "Tamaño en bits del int: ".PHP_INT_SIZE.'<br>';
echo "Número máximo almacenable en int: ".PHP_INT_MAX.'<br>';
echo "Número mínimo almacenable en int: ".PHP_INT_MIN.'<br>';
echo '0b<numero> convierte el número de binario a decimal<br>';
echo '0<numero> convierte el número de octal a decimal<br>';
echo '0x<numero> convierte el número de hexadecimal a decimal<br>';
$a = 0b100; // en binario
echo $a.' --> 0b100<br>';
$a = 0100;  // octal
echo $a.' --> 0100<br>';
$a = 0x100; // hexadecimal
echo $a.' --> 0x100<br>';
$a = 3/2;   // la división entre enteros no da problemas
echo $a.'<br>';	// 1.5	
$b = 7.5;
$a = (int) $b; // casting a int
echo $a.'<br>';	// 7, se trunca		
$b = 7e2; // notación científica
$b = 7E2;
$a = 73e-1; // 73*10**-1 = 73/10 = 1.3
echo $a.'<br>';
$numero_largo=PHP_INT_MAX+1; // Es mas grande que el numero almacenable
echo var_dump($numero_largo);

echo '<br><br><br>';

/*
 * Variables sin inicializar
 */

echo "<u><b>Variables no definidas</b></u>:<br>";
$var1 = 100; 
$var3 = 100 + $var2; // $var2 no existe, así que se toma como 0 y suelta warning
echo "$var3 <br>";   // muestra 100
$var3 = 100 * $var2; // $var2 no existe, así que se toma como 0 y suelta warning
echo "$var3 <br>";   // muestra 0
echo $var2,'<br>'; // No muestra nada y suelta warning

echo '<br><br>';

/*
 * Warnings y Errores
 */
 
echo "<u><b>Sumas de números y cadenas</b></u>:<br>";
$a = 1;
echo $a + "1".'<br>'; // Ok
echo $a + "10.4".'<br>'; // Ok
echo $a + "2e4".'<br>'; // Ok
//echo $a + "bob-3e2".'<br>'; // TypeError
echo $a + "5e2bob".'<br>'; // Warning

echo '<br><br><br>';


/*
 * Tipos de datos
 */

echo "<u><b>Tipos de datos y conversiones</b></u>:<br>";
$entero = 4; // tipo integer
$numero = 4.5;	 // tipo coma flotante
$cadena = "cadena"; // tipo cadena de caracteres
$bool = True; //tipo booleano
/* cambio de tipo de una variable */
$a = 5; // entero
echo gettype($a); // imprime el tipo de dato de a
echo "<br>";
$a = "Hola"; // cambia a cadena
echo gettype($a); // se comprueba que ha cambiado


echo (int) $numero;

echo '<br><br><br>';

/*
 * Conversiones de int
 */

echo "<u><b>Conversiones con intval()</b></u>:<br>";
echo intval('42'), PHP_EOL.'<br>'; // 42
echo intval(042), PHP_EOL.'<br>'; // 34
echo intval(1e4), PHP_EOL.'<br>'; // 10000
echo intval(42, 8), PHP_EOL.'<br>'; // 42
echo intval('42', 8), PHP_EOL.'<br>'; // 34
echo intval(array('foo', 'bar')), PHP_EOL.'<br>'; // 1
echo intval(0x1A), PHP_EOL; // 26

echo '<br><br><br>';


/*
 * Instanciaciones de Clases y su creación
 */

echo "<u><b>Creación o instanciación de clases</b></u>:<br>";
class StrValTest
{
    public function __toString() // Método mágico (ya existe)
    {
        return __CLASS__;
    }
}

echo strval(new StrValTest);

echo '<br><br><br>';

/*
 * Asignación de claves y valores
 */

echo "<u><b>Asignación de posiciones en array</b></u>:<br>";
$frase1[2]='Hola';
// El indice de 'mundo' en '$frase1'
// será uno más que el índice existente
$frase1[]='mundo'; // 
$frase2 = array('Adiós','mundo','cruel');
print_r($frase1); echo '<br>'; print_r($frase2); echo '<br>';
// El índice de un array puede ser un string
$paises=array('it'=>'Italia','es'=>'España','fr'=>'Francia');
$platos['it']='Pizza';
$platos['es']='Paella';
$platos['fr']='Quiche';
echo 'En '.$paises['es'].' la '.$platos['es']; echo '<br>';
echo 'En '.$paises['it'].' la '.$platos['it']; echo '<br>';
echo 'En '.$paises['fr'].' la '.$platos['fr']; echo '<br>';
echo 'Array $paises: '; print_r($paises); echo'<br><br>';

// Otro ejemplo
$arr1 = [ // Array escalar
	0 => 444,
	1 => 222,
	2 => 333,
];
print_r($arr1);
echo "<br>" . "pos 0: " . $arr1[0] . "<br>";
$arr1[0] = 555;
print_r($arr1); echo "<br>";

$arr2 = array ( // Array asociativo
	"1111A" => "Juan Vera Ochoa",
	"1112A" => "Maria Mesa Cabeza",
	"1113A" => "Ana Puertas Peral"
);		
$arr2["1113A"] = "Ana Puertas Segundo";
echo '<br>'; print_r($arr2);

$mes_festivos = array ( // Array asociativo 2
	"Enero" => "1 y 6",
	"Febrero" => "28",
	"Marzo" => "19",
	"Abril" => "17, 18, 21 y 23",
	"Mayo" => "1, 2 y 15",
	"Junio" => "9, 13, 24",
	"Julio" => "NULL",
	"Agosto" => "15",
	"Septiembre" => "8, 11, 15, 17, 24 y 25",
	"Octubre" => "12",
	"Noviembre" => "1",
	"Diciembre" => "6, 8 y 25"
);
echo '<br>'; print_r($mes_festivos);

echo '<br><br><br>';


/*
 * Array sin claves
 */

echo "<u><b>Array sin claves</b></u>:<br>";

$arr1 = array(10, 20, 30, 40); // Declaracion escalar
print_r($arr1); echo "<br>";

$arr1[] = 5; // Declaración sin clave (indice n+1 donde n=3)
print_r($arr1); echo "<br>";

$arr1[12] = 6; // De los indices 5 al 11, están vacíos
$arr1[11] = 5;
$arr1[] = 5; // Valor automático de índice 13 (n+1 donde n=12)
print_r($arr1);

echo '<br><br><br>';


/*
 * Igualdades
 */

echo "<u><b>Comparaciones con arrays</b></u>:<br>";

$arr1 = array(
	1 => "3000",
	2 => "4000",
);
$arr2 = array(
	1 => 3000,
	2 => 4000,
);
$arr3 = array(
	2 => "4000",
	1 => "3000",
);
if($arr1 == $arr2){ // Compara contenido
	echo "arr1 y arr2 son iguales <br>";
}else{
	echo "arr1 y arr2 no son iguales <br>";
}
if($arr1 == $arr3){ // Compara contenido
	echo "arr1 y arr3 son iguales <br>";
}else{
	echo "arr1 y arr3 no son iguales <br>";
}
if($arr1 === $arr2){ // Compara instancias
	echo "arr1 y arr2 son idénticos <br>";
}else{
	echo "arr1 y arr2 no son idénticos <br>";
}
if($arr1 === $arr3){ // Compara instancias
	echo "arr1 y arr3 son idénticos <br>";
}else{
	echo "arr1 y arr3 no son idénticos <br>";
}

echo '<br><br>';

/*
 * Funciones
 */
 
echo "<u><b>Funciones y parámetros</b></u>:<br>";

function sumar ($num1, $num2) {
	return $num1 + $num2;
}

echo sumar(2,4).'<br>';

// Función que ¿¿¿???
function acumular (&$a, $incremento) {
	$a += $incremento;
}

$acum = 1;
echo "Acumulador = $acum <br>";
for ($i = 0; $i<4; $i++) {
	acumular($acum, 4);
	echo "Acumulador = $acum <br>";
}

echo '<br><br>';

echo "<u><b>Funciones predefinidas</b></u>:<br>";

echo "func_num_arg() & func_num_args():";
function poner_modulo () {
	// Funcion que recoge en número de argumentos con la que fue llamada 'poner_modulo()' -> (func_num_args())
	for ($i=1; $i<func_num_args(); $i++) {
		// Convierte la variable actual en el argumento equivalente de la funcion
		echo func_get_arg($i);
	}
	echo '<br>';
}
poner_modulo('DES');
poner_modulo('Desarrollo', 'Entorno', 'Servidor');

echo '<br><br>';

function foo()
{
    $numargs = func_num_args();
    echo "Número de argumentos : $numargs \n";
    if ($numargs >= 2) {
        echo "El segundo argumento es : " . func_get_arg(1) . "\n";
    }
    $arg_list = func_get_args();
    for ($i = 0; $i < $numargs; $i++) {
        echo "El argumento $i es : " . $arg_list[$i] . "\n";
    }
}

foo(1, 2, 3);

echo "addslashes():";












?>
