<?php

// rol = 0: ADMINISTRADOR
// rol = 1: USUARIO NORMAL
$user1 = array(
    "user" => "user1",
    "pass" => "123",
    "rol" => 0
);
$user2 = array(
    "user" => "user2",
    "pass" => "321",
    "rol" => 0
);
$user3 = array(
    "user" => "user3",
    "pass" => "456",
    "rol" => 1
);
$user4 = array(
    "user" => "user4",
    "pass" => "654",
    "rol" => 0
);
$user5 = array(
    "user" => "user5",
    "pass" => "789",
    "rol" => 1
);

$arr_usuarios["user1"] = $user1;
$arr_usuarios["user2"] = $user2;
$arr_usuarios["user3"] = $user3;
$arr_usuarios["user4"] = $user4;
$arr_usuarios["user5"] = $user5;

// Se mete solo si se ha enviado anteriormente el formulario
if ($_SERVER['REQUEST_METHOD']=="POST") {
    
    // Recogemos los datos del formulario y los almacenamos en un array
    $usuario_introducido = array(
        "user" => $_POST['usuario'],
        "pass" => $_POST['clave']
    );

    // Recorremos el array de usuarios existentes
    foreach ($arr_usuarios as $usuario_existente) {
        // Empezamos a ver si el usuario introducido coincide con alguno existente
        if ($usuario_existente["user"] == $usuario_introducido["user"] &&
            $usuario_existente["pass"] == $usuario_introducido["pass"]) {
                // Si llega aqui, el usuario introducido existe
                // Comprobamos el rol del usuario
                if ($usuario_existente["rol"]==0) {
                    header("Location:administracion.php");
                } else if ($usuario_existente["rol"]==1) {
                    header("Location:principal.php");
                }
        } else {
            $err=true;
            $usuario=$_POST['usuario'];
        }
    }
}
?>
<html>
<body>
    <!-- Script PHP -->
    <?php 
        if(isset($err)) {
            echo "Revise usuario y contraseña";
        }
    ?>

    <!-- Inicio Formulario -->
    <form method="POST" 
          action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
        <!-- Input Usuario -->
        <input value="<?php if (isset($usuario)) echo $usuario; ?>" 
               id="usuario" 
               name="usuario" 
               type="text"
               placeholder="Usuario">
        <!-- Input contraseña -->
        <input id="clave" 
               name="clave" 
               type="password"
               placeholder="Contraseña">
        <!-- Botón Submit -->
        <input type="submit">
    </form>

</body>
</html>
