
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>sin título</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.38" />
</head>

<body>
	<?php
	/*
	 * Realizar un codigo php que calcule el 
	 * area de un circulo a partir del valor 
	 * del radio que entra por un formulario 
	 */
	
	// Declaración de variables
	define("PI", 3.141592);
	$radio = $_POST['radio'];
	
	// Cálculo del área
	$area = PI*$radio**2;
	
	// Resultado
	echo "Radio introducido: $radio<br>";
	echo "Área del círculo: $area unidades cuadradas";
	
	?>
	
	<h2>Cálculo de área con radio</h2>
	<form method="post">
		<input type="number" name="radio" placeholder="Radio del círculo">
		<button type="submit">Enviar</button>
	</form>
</body>

</html>
