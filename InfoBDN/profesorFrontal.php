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
        encabezado();
        navegacion();
        $usuario = $_SESSION["profesor"];
        $id = $usuario[0];
        $nombre = $usuario[2];
        $apellido = $usuario[3];
        
        echo "<h2> Hola $usuario[2] $usuario[3]</h2></br>";
        $consulta = cursosProfesor($id);
        tablaCursosProfesor($consulta, $nombre, $apellido);
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