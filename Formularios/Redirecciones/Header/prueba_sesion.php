<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST"){

  if (!is_empty($_POST['nombre']) and !is_empty($_POST["apellidos"])){

    $_SESSION['nombre']=$_POST['nombre'];
    $_SESSION['apellidos']=$_POST['apellidos'];
    header("location:sesion_iniciada.php");
  }else{
    $err=true;
    $nombre=$_POST['nombre'];
    $apellidos=$_POST['apellidos'];
  }
}
?>

<!DOCTYPE html>
<html>
<body>
<?php if(isset($err)){
echo "revise usuario y apellidos";
}?>

<form method = "POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<label for = "Nombre"> Nombre </label>
<input value ="<?php if (isset ($nombre)) echo $nombre;?> "id="nombre" name="nombre" type="text">
<label for = "Apoellidos"> Apellidos </label>
<input value ="<?php if (isset ($apellidos)) echo $apellidos;?> "id="apellidos" name="apellidos" type="text">
<input type = "submit">

</form>

</body>
</html>