<?php

$a="Variable principal";
for ($i=0; $i<3; $i++) {
  include "archivo_incluir.php";
  // require "archivo_incluir.php";
  echo '<br>';
}

for ($i=0; $i<3; $i++) {
  include_once "archivo_incluir.php";
  //require_once "archivo_incluir.php"; si provocaria error fatal y no warning
  echo "Ya ha sido incluido anteriormente <br>";
}

$b="Otra variable principal";
echo "<br>En el script principal $a y $b";
	
?>

