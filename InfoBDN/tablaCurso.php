<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="estilos/general.css">
    <title>anadir profesor</title>
</head>
<body>
<?php 

include("funcionesBdn.php");

// comprobamos si el usuario está conectado
if(isset($_SESSION["rol"])){
    if($_SESSION["rol"] == 3){
        if(isset($_GET['Numero'])){
            $id= $_GET['Numero'];
            $usuario = $_SESSION["profesor"];
            $DNI = $usuario[0];
            $nombreProfesor = $usuario[2];
            $apellidoProfesor = $usuario[3];
        
        echo "<h2> Hola $nombreProfesor $apellidoProfesor</h2></br>";
            $BBDD="infobdn";
            encabezado();
            navegacion();
            $consulta = alumnosCurso($BBDD, $id);
            tablaAlumnos($consulta);
        }

        echo "<div class = 'profe'>";
        echo "<a href='modificarProfesor.php?Numero=".$id."'> Modificar datos </a></br>";
        echo "<a href='fotoProfesor.php?Numero=".$id."'> modificar foto </a>";
        echo "</div>";

        footer();

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