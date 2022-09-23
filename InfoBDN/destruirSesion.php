<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>destruirSesion</title>
</head>
<body>
<?php 
//tras destruir sesión informo al usuario que se ha cerrado correctamente
if(isset($_SESSION["usuario"])){
    session_unset();
    session_destroy();
    echo "<h1> Has cerrado correctamente la sesión </h1>";
    ?>
    <meta http-equiv="refresh" content="5; url= validacion.php">
    <?php
}

//aunque sea la página de destruir sesión por seguridad no permito entrar aquí
else{
    echo "<h1> Has de estar validado para ver esta página </h1>";
    ?>
        <meta http-equiv="refresh" content="5; url= validacion.php">
        <?php
}
?>   
</body>
</html>