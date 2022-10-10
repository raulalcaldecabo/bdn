<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="estilos/general.css">
    <title>consultar cursos</title>
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
        if(isset($_GET['Numero'])){
            $tramite = $_GET['Numero'];
            $BBDD="infobdn";
            $conexion = conectar($BBDD);
            if($conexion == false){
                mysqli_connect_error();
            }
            else{
                $sql = "INSERT INTO matricula (idCurso, idAlumno) values ('$tramite', '$id')";
            }
            //la enviamos a la base de datos
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta == false){
                mysqli_error($conexion);
            }
            ?>
            <meta http-equiv="refresh" content="0; url= consultarCursos.php">
            <?php
        }
        else{
            encabezado();
            navegacion();
            echo "<h2> cursos disponibles para ti $usuario[2] $usuario[3]</h2></br>";
            $BBDD="infobdn";
            $consulta = cursosDisponibles($BBDD, $id);
            $i=0;
            $numlineas = mysqli_num_rows($consulta);
            while($i< $numlineas){
                $linea = mysqli_fetch_array($consulta);
                $id=$linea[0];
                $foto=$linea[8];
                echo "<div class = 'cursos'>";
                echo "<h2> $linea[1] </h2>";
                echo "<img height = '500px' width= '500px' src = ".$foto." <br/>";
                echo "<p> $linea[2] </p>";
                echo "<p class='negrita'> $linea[3] horas en total</p>";
                echo "<p class='negrita'> Fecha de inicio: $linea[4] </p>";
                echo "<p class='negrita'> Fecha fin:  $linea[5] </p>";
                echo " <br/>";
                echo "<a href='consultarCursos.php?Numero=".$id."'><button class='Matricula'> matricularse </button></a>";
                echo "</div>";
                echo " <br/>";
                $i++;
            }
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