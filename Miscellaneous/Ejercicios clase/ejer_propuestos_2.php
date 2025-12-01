<?php

echo "<b>=== APARTADO A ===</b>".'<br>';

$miFecha = 
array(
	array(
		array("13 de enero de 2015", "11 de febrero de 2018"),
		array("13 de enero de 2020", "11 de febrero de 2015"),
	),
	array(
		array("3 de agosto de 2017", "1 de octubre de 2016"),
		array("3 de agosto de 2013", "1 de octubre de 2019"),
	),
	array(
		array("10 de junio de 2020", "11 de marzo de 2019"),
	),
	array(
		array("22 de marzo de 2020", "28 de mayo de 2019"),
		array("22 de marzo de 2019", "28 de mayo de 2018"),
		array("22 de marzo de 2018", "28 de mayo de 2017"),
		array("22 de marzo de 2017", "28 de mayo de 2016"),
	)
);

for ($x = 0; $x < count($miFecha); $x++) {
	for ($y = 0; $y < count($miFecha[$x]); $y++) {
		for ($z = 0; $z < count($miFecha[$x][$y]); $z++) {
			echo '$miFecha'."[$x][$y][$z]=".$miFecha[$x][$y][$z];
			echo '<br>';
		}
	}
}

echo '<br><br>';

echo "<b>=== APARTADO B ===</b>".'<br>';

$equipo_futbol = 
array(
	array("Rooney","Chicharito","Gigs"),
	array("Suarez"),
	array("Torres","Terry","Etoo")
);

for ($x = 0; $x < count($equipo_futbol); $x++) {
	for ($y = 0; $y < count($equipo_futbol[$x]); $y++) {
		echo '$equipo_futbol'."[$x][$y]=".$equipo_futbol[$x][$y];
		echo '<br>';
	}
}



?>
