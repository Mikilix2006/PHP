<?php 
if ($_SERVER['REQUEST_METHOD']=="POST") {
    if ($_POST['usuario'] == "usuario" && $_POST['clave'] == "1234") {
        header("Location:principal.php");
    } else {
        $err=true;
        $usuario=$_POST['usuario'];
    }
}
?>

<!DOCTYPE html>
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
