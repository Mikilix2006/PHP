<?php

$options = [
     // Aumenta el costo de bcrypt de 12 a 13.
    'cost' => 13,
];

$hash = password_hash("rasmuslerdorf", PASSWORD_BCRYPT, $options);

echo $hash . "<br>";

if (password_verify('rasmuslerdorf', $hash)) {
    echo 'La contraseña es válida !';
} else {
    echo 'La contraseña es inválida.';
}

?>