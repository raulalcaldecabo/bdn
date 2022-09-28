<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>principal alumno</title>
</head>
<body>
<?php 

include("funcionesBdn.php");

// comprobamos si el usuario está conectado
if(isset($_SESSION["rol"])){
    if($_SESSION["rol"] == 2){
        $usuario = $_SESSION["alumno"];
        $id = $usuario[0];
        $nombre = $usuario[2];
        $apellido = $usuario[3];
        
        echo "<h1> Hola $usuario[2] $usuario[3]</h1></br>";

        $BBDD="infobdn";
        $matriculas = consultaMatriculas($BBDD, $id);
        alumnoMatriculas($matriculas);
        echo "<h1> ¿Qué gestión deseas realizar? </h1></br>";
        echo "<a href='consultarCursos.php'> consultar cursos </a></br>";
        echo "<a href='destruirSesion.php'>Salir de la sesión</a>";    
        
    }

    else{
        echo "<h1> No tienes permisos para ver esta página </h1>";
    }
}
else{
    echo "<h1> Has de estar validado para ver esta página </h1>";
}


?>
</body>
</html>