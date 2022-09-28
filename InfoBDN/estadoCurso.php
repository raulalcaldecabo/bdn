<?php session_start(); ?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cambiar foto curso</title>
</head>

<body>   
<?php

include("funcionesBdn.php");

// comprobamos si el usuario está conectado
if(isset($_SESSION["rol"])){
    if($_SESSION["rol"] == 1){
        if(isset($_GET['Numero'])){
            $id = $_GET['Numero'];
            estadoCurso($id);
        } 
    }
    else{
        echo "<h1> No tienes permisos para ver esta página </h1>";
        ?>
            <meta http-equiv="refresh" content="5; url= landpage.php">
        <?php
    } 
} 
else{
    echo "<h1> Has de estar validado para ver esta página </h1>";
    ?>
        <meta http-equiv="refresh" content="5; url= landpage.php">
    <?php
}



?>
</body>
</html>

