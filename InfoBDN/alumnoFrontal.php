<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="landpage.css">
    <title>principal alumno</title>
</head>
<body>
<?php 

include("funcionesBdn.php");
include("maquetacion.php");

// comprobamos si el usuario está conectado
if(isset($_SESSION["rol"])){
    if($_SESSION["rol"] == 2){
        $usuario = $_SESSION["alumno"];
        $id = $usuario[0];
        $nombre = $usuario[2];
        $apellido = $usuario[3];
        $BBDD="infobdn";

        if(isset($_GET['Numero'])){
            $conexion = conectar($BBDD);
            $eliminar = $_GET['Numero'];
            borrarCurso($eliminar, $conexion);
        }
        else{
            encabezado();
            echo "<h1> Hola $usuario[2] $usuario[3]</h1></br>";
            $matriculas = consultaMatriculas($BBDD, $id);
            alumnoMatriculas($matriculas);
            echo "<h1> ¿Qué gestión deseas realizar? </h1></br>";
            echo "<a href='consultarCursos.php'> consultar cursos </a></br>";
            echo "<a href='modificarAlumno.php'>Editar alumno</a></br>";
            echo "<a href='fotoAlumno.php'>Editar foto alumno</a></br>";
        }
          
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