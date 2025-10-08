<?php
	$menu = "=== MENU ===<br>
			1. LEER<br>
			2. ESCRIBIR<br>
			3. MODIFICAR<br>
			0. SALIR<br>
			>";
	$incorrecto = true;
	$opcion = 6;
		
	/*
	 * ERROR EN LINEA 19 -> EL IF NO FUNCIONA
	 * 
	do {
		echo $menu;
		($opcion > 3 || $opcion < 0) ? $incorrecto = true : $incorrecto = false;
		echo $opcion.'<br>';
		// Mensaje en funcion de si es incorrecto o no
		$incorrecto ? echo "Opción no válida -> $opcion" : echo "Gracias";
		// Cambio valor de la opcion
		switch ($opcion) {
			case 6:
				$opcion = -1;
				break;
			case -1:
				$opcion = 2;
				break;
			default:
				break;
		}
	} while ($incorrecto);
	*/
	
	do {
		echo $menu;
		($opcion > 3 || $opcion < 0) ? $incorrecto = true : $incorrecto = false;
		echo $opcion.'<br>';
		// Cambio valor de la opcion
		switch ($opcion) {
			case 6:
				$opcion = -1;
				break;
			case -1:
				$opcion = 2;
				break;
			default:
				break;
		}
	} while ($incorrecto);
	
?>
