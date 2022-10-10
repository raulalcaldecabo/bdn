<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="estilos/general.css">
    <title> administrar cursos</title>
</head>
<body>
<?php 

include("funcionesBdn.php");

// comprobamos si el usuario está conectado
if(isset($_SESSION["rol"])){
    if($_SESSION["rol"] == 1){
        if(isset($_GET['Numero'])){
            $eliminar = $_GET['Numero'];
            $BBDD = "infobdn";
            $conexion = conectar($BBDD);
            if ($conexion == false){
                mysqli_connect_error();
            }
            else{
                //funcion para borrar un curso
                borrarCurso($eliminar, $conexion);
                ?>
                    <meta http-equiv="refresh" content="0; url= adminCursos.php">
                <?php
            }
        }
        
        else{
            encabezado();
            navegacion();

            echo "<form class= 'buscador' action = 'resultado.php' method = 'POST' name = 'buscador'>";
            echo "buscador:<input type='text' id='buscador' name='buscador' placeholder='buscador'";
            echo "<button type='submit'></button>";
            echo "</form>";

            $BBDD="infobdn";

            $cursos = consultaCursos($BBDD);
            tablaCursos($cursos);

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