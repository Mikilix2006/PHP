<?php

if ($_SERVER['REQUEST_METHOD']=="POST") {

    try {
        $cadena_conexion = 'mysql:dbname=BBDD1;host=127.0.0.1';
        $usuario = 'root';
        $password = '';
        
        // Conexion a BBDD
        $bd = new PDO($cadena_conexion, $usuario, $password);
        // Recuperar y almacenar datos
        $sql = 'SELECT user, password, rol FROM usuarios';
        $result = $bd->query($sql);

        // Comprobacion de credenciales en la BBDD
        $usuario_correcto = false;
        foreach ($result as $row) {
            if ($_POST['user'] == $row['user'] && 
                password_verify($_POST['password'], $row['password'])) {
                $usuario_correcto = true;
                echo "Access granted";
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
        if(!$usuario_correcto) {
            echo "Revise user y contraseña";
        }
    ?>

    <!-- Inicio Formulario -->
    <form method="POST" 
          action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
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
