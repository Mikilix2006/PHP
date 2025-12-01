<html>
<head>
<title>Calculos </title>
</head>
<body>
<h1>Calculos, redondeo y formato. </h1>
<?php

/* APARTADO A */
echo '<b>APARTADO A</b><br>';

$miFecha = array(
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

print_r($miFecha);

echo '<br><br><br>';


/* APARTADO B */
echo '<b>APARTADO B</b><br>';

$equipo_futbol = array
(
array("Rooney","Chicharito","Gigs"),
array("Suarez"),
array("Torres","Terry","Etoo")
);

print_r($equipo_futbol);

echo '<br><br><br>';


/* APARTADO C */
echo '<b>APARTADO C</b><br>';

$datos = array(
array(array(0, 0, 0),
array(0, 0, 1),
array(0, 0, 2)
),
array(array(0, 1, 0),
array(0, 1, 1),
array(0, 1, 2)
),
array(array(0, 2, 0),
array(0, 2, 1),
array(0, 2, 2)
)
);

print_r($datos);

echo '<br><br><br>';


/* APARTADO D */
echo '<b>APARTADO D</b><br>';

$supermercado = array("Electrodomesticos" => array("Televisor", "Heladera"),
"alimentos" => array("Carne", "Leche", "Verduras"));

print_r($supermercado);

echo '<br><br><br>';


/* APARTADO E */
echo '<b>APARTADO E</b><br>';

$productos=array(
"procesador" => array (
"AMD" => "K7 XP 1800",
"PENTIUM" => "IV 2,5 Ghz"
),
"disco_duro" => array(
"SEAGATE" => "40GB 10000 rpm",
"SAMSUNG" => "40GB 7200 rpm",
"WESTERN_DIGITAL" => "60GB 7200 rmp 8MB caché"
)
);

print_r($productos);

echo '<br><br><br>';


/* APARTADO F */
echo '<b>APARTADO F</b><br>';

$productos["procesador"]["AMD"][0]="K7 XP 1900";
$productos["procesador"]["AMD"][1]="K7 XP 1800";
$productos["procesador"]["AMD"][2]="K7 XP 1700";
$productos["procesador"]["PENTIUM"][0]="IV 2,5 Ghz";
$productos["procesador"]["PENTIUM"][1]="IV 2,4 Ghz";
$productos["procesador"]["PENTIUM"][2]="IV 2,3 Ghz";
$productos["procesador"]["PENTIUM"][3]="IV 2,2 Ghz";
$productos["disco_duro"]["SEAGATE"][0]=" 40GB 10000 rpm";
$productos["disco_duro"]["SEAGATE"][1]=" 80GB 7200 rpm";
$productos["disco_duro"]["SEAGATE"][2]=" 160GB 7200 rpm";
$productos["disco_duro"]["SAMSUNG"][0]=" 40GB 7200 rpm";
$productos["disco_duro"]["WESTERN_DIGITAL"][0]=" 60GB 7200 rpm 8MB
cache";
$productos["disco_duro"]["WESTERN_DIGITAL"][1]=" 80GB 10000 rpm 16MB
cache";

print_r($productos);

?>
</body>
</html>