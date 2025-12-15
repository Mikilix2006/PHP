<?php
// Declaración de matriz tridimensional mediante arrays()
// Motociclismo => Categoría, Escudería, Piloto (Primario, Secundario)
$motociclismo = array(
    array("categoria" => "MotoGP",
        array("escuderia" => "Ducati Lenovo",
            array("piloto" => "Francesco Bagnaia, Italia"),
            array("piloto" => "Marc Marquez, España")
        ),
        array("escuderia" => "Yamaha",
            array("piloto" => "Fabio Quartararo, Francia"),
            array("piloto" => "Álex Rins, España")
        ),
        array("escuderia" => "Honda",
            array("piloto" => "Luca Marini, Italia"),
            array("piloto" => "Joan Mir, España")
        )
    ),
    array("categoria" => "Moto2",
        array("escuderia" => "MT Helmets",
            array("piloto" => "Iván Ortolá, España"),
            array("piloto" => "Sergio García Dols, España")
        ),
        array("escuderia" => "Pramac Racing",
            array("piloto" => "Tony Arbolino, Italia"),
            array("piloto" => "Izan Guevara, España")
        ),
        array("escuderia" => "Fantic Racing",
            array("piloto" => "Aron Canet, España"),
            array("piloto" => "Barry Baults, Bélgica")
        )
    ),
    array("categoria" => "Moto3",
        array("escuderia" => "Honda",
            array("piloto" => "Tatchakorn Buasri, Tailandia"),
            array("piloto" => "Taiyo Furusato, Japón")
        ),
        array("escuderia" => "Ángel Nieto Team",
            array("piloto" => "Máximo Quiles, España"),
            array("piloto" => "Dennis Foggia, Italia")
        ),
        array("escuderia" => "MT Helmets",
            array("piloto" => "Ryusei Yamanaka, Japón"),
            array("piloto" => "Ángel Piqueras, España")
        )
    ),
);

$json = json_encode($motociclismo);

echo $json;
?>