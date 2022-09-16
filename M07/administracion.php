<?php session_start(); ?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>administracion</title>
</head>

<body>
    <?php
    // comprobamos si el usuario está conectado
    if(isset($_SESSION["rol"])){
        if($_SESSION["rol"] == 1){
            $linea = $_SESSION["usuario"];
            echo "<h1> ¿Qué gestión desea realizar? </h1>";
            echo "<a href='modCursos.php'> modificar cursos </a></br>";
            echo "<a href='modProf.php'> modificar profesores </a>";
            echo "<a href='adCursos.php'> añadir cursos </a></br>";
            echo "<a href='adProf.php'> añadir profesores </a>";
        }
        else{
            echo "<h1> Has de estar validado para ver esta página </h1>";
        }
    }
    else{
        echo "<h1> Has de estar validado para ver esta página </h1>";
    }
    ?> 
</body>
</html>