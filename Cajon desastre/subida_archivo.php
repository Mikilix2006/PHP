<?php
	$tam = $_FILES["subida_archivo.html"]["size"];
	if($tam > 256 *1024){
		echo "<br>Demasiado grande";
		return;
	}
	echo "Nombre del fichero: " . $_FILES["subida_archivo.html"]["name"];
	echo "<br>Nombre temporal del fichero en sel servidor: " . $_FILES["subida_archivo.html"]["tmp_name"];	
	$res = move_uploaded_file($_FILES["subida_archivo.html"]["tmp_name"],"subidos/".$_FILES["fichero"]["name"]);
    if($res){
		echo "<br>Fichero guardado";
    } else {
        echo "<br>Error";
    }
?>