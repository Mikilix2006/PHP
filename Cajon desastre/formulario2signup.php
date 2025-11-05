<?php



?>
<html>
<body>
    <?php
    if (isset($err)) {
        echo "Revise";
    }
    ?>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
        REGISTRE SUS DATOS:<br><br>
        <!--
        inputs:
            nombre       : texto
            apellidos    : texto
            edad         : numero
            email        : email
            intereses    : checkbox         : name -> intereses[]
            genero       : radio
            profesion    : select simple    
            nacionalidad : select multiple  : name -> nacionalidad[]
            clave        : password
        -->
        <label for="nombre"> Nombre </label>
        <input type="text" id="nombre" name="nombre" value="<?php if (isset($nombre)) echo $nombre; ?>" placeholder="Nombre">
        <br><br>
        <label for="apellidos"> Apellidos </label>
        <input type="text" id="apellidos" name="apellidos" value="<?php if (isset($apellidos)) echo $apellidos; ?>" placeholder="Apellidos">
        <br><br>
        <label for="edad"> Edad </label>
        <input type="number" id="edad" name="edad" value="<?php if (isset($edad)) echo $edad; ?>" placeholder="Edad">
        <br><br>
        <label for="email"> Email </label>
        <input type="email" id="email" name="email" value="<?php if (isset($email)) echo $email; ?>" placeholder="Email">
        <br><br>
        <label for="intereses[]"> Intereses </label> <br>
        <input type="checkbox" id="intereses[]" name="intereses[]" value=""> Deportes <br>
        <input type="checkbox" id="intereses[]" name="intereses[]" value=""> Deportes <br>
        <input type="checkbox" id="intereses[]" name="intereses[]" value=""> Deportes <br>
        <br><br>
    </form>
</body>
</html>