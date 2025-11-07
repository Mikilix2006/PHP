<?php 
	$arr2 = array (
		"1111A" => "Juan Vera Ochoa",
		"1112A" => "Maria Mesa Cabeza",
		"1113A" => "Ana Puertas Peral"
	);
	
	$mes_festivos_asociativo = array (
		"Enero" => 2,
		"Febrero" => 1,
		"Marzo" => 1,
		"Abril" => 4,
		"Mayo" => 3,
		"Junio" => 3,
		"Julio" => 0,
		"Agosto" => 1,
		"Septiembre" => 6,
		"Octubre" => 1,
		"Noviembre" => 1,
		"Diciembre" => 3
	);
	$mes_festivos_escalar = array (2,1,1,4,3,3,0,1,6,1,1,3);

	foreach ($arr2 as $nombre) {
		echo "$nombre <br>";		
	}
	echo '<br>';
	
	foreach ($arr2 as $codigo => $nombre) {
		echo "Código: $codigo Nombre: $nombre <br>";		
	}
	echo '<br>';
	
	foreach ($mes_festivos_asociativo as $mes => $festivos) {
		echo "Mes: $mes || Días festivos: $festivos <br>";		
	}
	echo '<br>';
	
	print_r($mes_festivos_escalar);
	echo '<br><br>';
	
	$matriz_bidimenisonal = [
		[1,2,3],
		[4,5,6],
		[7,8,9]
	];
	
	echo "=== VISUALIZACION DE MATRIZ BISIMENSIONAL ===".'<br>';
	echo "Mediante for:".'<br>';
	echo "[".'<br>';
	for ($fila = 0; $fila < 3; $fila++) {
		echo "[";
		for ($col = 0; $col < 3; $col++) {
			echo "FILA: $fila COLUMNA: $col => ". $matriz_bidimenisonal[$fila][$col];
			if ($col != 2) echo ", ";
		}
		echo "]";
		if ($fila != 2) echo '<br>';
	}
	echo '<br>'."]".'<br><br>';
	
	
	
	
	echo "Mediante foreach:".'<br>';
	$num_fila = 0;
	$num_col = 0;
	echo "[".'<br>';
	foreach ($matriz_bidimenisonal as $fila) {
		echo "[";
		foreach ($fila as $col) {
			echo "FILA: $num_fila COLUMNA: $num_col => ". $col;
			if ($num_col != 2) echo ", ";
			$num_col++;
		}
		echo "]".'<br>';
		$num_fila++;
		$num_col = 0;
	}
	echo "]".'<br>';
	
	
	
	
	
	
?>
