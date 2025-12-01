<?php

session_start();

if ($_SERVER['REQUEST_METHOD']=="POST") {

    try {
        // Guardamos usuario introducido
        $user = $_POST['user'];

        include "CFGINI.php";
        
        // Conexion a BBDD
        $bd = new PDO($cadena_conexion, $usuario, $password);

        // Recuperar y almacenar datos
        $sql = 'SELECT user, password, rol FROM usuarios';
        $result = $bd->query($sql);

        // Comprobacion de credenciales en la BBDD
        $usuario_correcto = false;
        foreach ($result as $row) {
            if ($user == $row['user'] && 
                password_verify($_POST['password'],$row['password'])) {
                $usuario_correcto = true;
                $_SESSION['nombre'] = $user;
                if ($row['rol'] == 0) {
                    header("location:PanelBusquedas.php");
                } elseif ($row['rol'] == 1) {
                    header("location:PanelAdministrador.php");
                }
            }
        }
    } catch (PDOException $e) {
		echo 'Error: ' . $e->getMessage();
	}
}

?>

<!DOCTYPE html>
<html>
<body>
    <!-- Script PHP -->
    <?php 
        if(isset($usuario_correcto)) {
            echo "Revise user y contraseña";
        }
    ?>

    <!-- Inicio Formulario -->
    <form method="POST" 
          action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
        <p>LOGIN</p>
        <!-- Input user -->
        <input value="<?php if (isset($user)) echo $user; ?>" 
               id="user" 
               name="user" 
               type="text"
               placeholder="user">
        <!-- Input contraseña -->
        <input id="password" 
               name="password" 
               type="password"
               placeholder="Contraseña">
        <!-- Botón Submit -->
        <input type="submit">
    </form>

</body>
</html>
