<?php
// Declaración de matriz tridimensional mediante array()
// Motociclismo => Categoría, Escudería, Piloto (0 Primario, 1 Secundario)
$motociclismo = array(
    "MotoGP" => array(
        "Ducati Lenovo" => array(
            0 => "Francesco Bagnaia, Italia",
            1 => "Marc Marquez, España"
        ),
        "Yamaha" => array(
            0 => "Fabio Quartararo, Francia",
            1 => "Álex Rins, España"
        ),
        "Honda" => array(
            0 => "Luca Marini, Italia",
            1 => "Joan Mir, España"
        )
    ),
    "Moto2" => array(
        "MT Helmets" => array(
            0 => "Iván Ortolá, España",
            1 => "Sergio García Dols, España"
        ),
        "Pramac Racing" => array(
            0 => "Tony Arbolino, Italia",
            1 => "Izan Guevara, España"
        ),
        "Fantic Racing" => array(
            0 => "Aron Canet, España",
            1 => "Barry Baults, Bélgica"
        )
    ),
    "Moto3" => array(
        "Honda" => array(
            0 => "Tatchakorn Buasri, Tailandia",
            1 => "Taiyo Furusato, Japón"
        ),
        "Ángel Nieto Team" => array(
            0 => "Máximo Quiles, España",
            1 => "Dennis Foggia, Italia"
        ),
        "MT Helmets" => array(
            0 => "Ryusei Yamanaka, Japón",
            1 => "Ángel Piqueras, España"
        )
    )
);

$json = json_encode($motociclismo);
echo $json;

?>