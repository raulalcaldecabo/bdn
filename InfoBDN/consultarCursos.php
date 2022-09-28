<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            echo "<h1> cursos disponibles para ti $usuario[2] $usuario[3]</h1></br>";

            $BBDD="infobdn";
            $consulta = cursosDisponibles($BBDD);
            $i=0;
            $numlineas = mysqli_num_rows($consulta);
            while($i<= $numlineas){
                $linea = mysqli_fetch_array($consulta);
                $id=$linea[0];
                echo "<div>";
                echo "<p> $linea[1] </p>";
                echo "<p> $linea[8] </p>";
                echo "<p> $linea[2] </p>";
                echo "<p> $linea[3] </p>";
                echo "<p> $linea[4] </p>";
                echo "<p> $linea[5] </p>";
                echo "<a href='consultarCursos.php?Numero=".$id."'><button class='Matricula'> matricularse </button></a>";
                echo "</div>";
                $i++;
            }

            foreach($consulta as $curso => $campo){
                $id=$campo["ID"];
                echo "<div>";
                foreach($campo as $dato){
                    if($campo == $campo["ID"]){
                        continue;
                    }
                    echo "<p> $dato </p>";
                }
                echo "<a href='consultaCursos.php?Numero=".$id."'><button class='Matricula'> matricularse </button></a>";
                echo "</div>";
            }
        }
        
        echo "<h1> ¿Qué gestión deseas realizar? </h1></br>";
        echo "<a href='alumnoFrontal.php'> consultar cursos </a></br>";
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