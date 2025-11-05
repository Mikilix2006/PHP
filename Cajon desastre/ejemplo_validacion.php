<html>
<head>
<meta charset="utf-8">
<title>Validacion de formulario con PHP</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<style>
.error {color: #FF0000;}
.invalid-feedback{ display:block !important}
</style>
</head>
<body>
<?php
// Definir variables
$nombreErr = $emailErr = "";
$nombre = $email = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (empty($_POST["nombre"])) {
$nombreErr = "Nombre es requerido";
}else {
$nombre = validar_input($_POST["nombre"]);
if (strlen($nombre) >= 10 && strlen($nombre) <= 20) {
// 2. Verificar si el nombre contiene solo caracteres alfabéticos
if (preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+$/", $nombre)) {
echo "El nombre es válido y cumple los requisitos.";
} else {
echo "El nombre contiene caracteres no alfabéticos.";
}
} else {
echo "El nombre no tiene la longitud correcta (10-20 caracteres).";
}
}
if (empty($_POST["email"])) {
$emailErr = "Email es requerido";
}else {
$email = validar_input($_POST["email"]);
// Verifica el correcto formato de email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
$emailErr = "Formato de email invalido";
}
}
}
function validar_input($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}
?>
<div class="container">
<br>
<div class="card bg-light">
<div class="card-header">
Formulario de registro con validación
</div>
<div class="card-body">
<span class = "error">* Campos requeridos.</span><br><br>
<div class="row">
<div class="col-md-6">
<form method="post" action="<?php
echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<div class="form-group">
<label class="col-form-label"><span class="error">* </span>Nombre</label>
<input name="nombre" type="text" class="form-control" value="<?php if (!empty($_POST["nombre"])) {
echo $nombre; }else {echo "";}?>">
<span class="error invalid-feedback"> <?php echo $nombreErr;?></span>
</div><br><br>
<div class="form-group">
<label class="col-form-label"><span class="error">* </span>Email</label>
<input name="email" type="text" class="form-control" value="<?php if (!empty($_POST["email"])) {
echo $email; }else {echo "";}?>">
<span class="error invalid-feedback"> <?php echo $emailErr;?></span><br><br>
</div>
<div class="form-group">
<button class="btn btn-primary btn-block" name="submit">Enviar</button>
</div>
</form>
</div>

</div>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (empty($nombreErr) and empty($emailErr)) {
echo "<br><h6>Tus valores son:</h6>";
echo "<strong>Nombre</strong>: ".$nombre;
echo "<br>";
echo "<strong>Email</strong>: ".$email;
echo "<br>";
}
}
?>
</div>
</div>
</div>
</body>
</html>