<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="estilos/general.css">
    <title>principal alumno</title>
</head>
<body>
<?php 

include("funcionesBdn.php");

// comprobamos si el usuario está conectado
if(isset($_SESSION["rol"])){
    if($_SESSION["rol"] == 2){
        if(isset($_GET['Numero'])){
            $usuario = $_SESSION["alumno"];
            $id = $usuario[0];
            $nombre = $usuario[2];
            $apellido = $usuario[3];
            $BBDD="infobdn";

            $conexion = conectar($BBDD);
            $eliminar = $_GET['Numero'];
            borrarCurso($eliminar, $conexion);
        }
        else{
            $usuario = $_SESSION["alumno"];
            $id = $usuario[0];
            $nombre = $usuario[2];
            $apellido = $usuario[3];
            encabezado();
            navegacion();
            echo "<h2> Hola $usuario[2] $usuario[3]</h2></br>";
            $matriculas = consultaMatriculas($id);
            alumnoMatriculas($matriculas);
            
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