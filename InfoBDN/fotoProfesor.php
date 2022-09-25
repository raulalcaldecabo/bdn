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
            echo "<form action = 'fotoCurso.php method = 'POST' name = 'foto' ENCTYPE = 'multipart/form-data'>";
            echo "id <input type = 'hidden' name = 'Numero' value = '$id' size = '3' maxlength='3'></br>";
            echo "foto <input type = 'file' name = 'foto' accept = '.png, .jpg, jepg'> </br>";
            echo "<input type='submit' name='crearprof' value='crearprof'>";
            echo "</form>";
        }
        if(isset($_GET['foto'])){
            if(is_uploaded_file()){
                $lugar = "immagen/";$_FILES['foto']['tmp_name'];
                $id = $_GET['Numero'];
                $fichero = $id."-".$_FILES['foto']['tmp_name'];
                $directorio = $lugar.$fichero;
                move_uploaded_file($_FILES['foto']['tmp_name'],$lugar.$fichero);
            }
            else{
                echo("no se ha subido la foto");
            }
            $BBDD="infobdn";   
            $conexion = conectar($BBDD);
            if ($conexion == false){
                mysqli_connect_error();
            }
            else{

                $sql = "UPDATE profesores SET pfoto = '$directorio' WHERE ID = '$id";
                $consulta = mysqli_query($conexion, $sql);
                if ($consulta == false){
                    mysqli_error($conexion);
                }
                else{
                    $modificar = mysqli_query($conexion, $sql);
                    echo "<h1> Modificación realizada con éxito </h1>";
                    ?>
                        <meta http-equiv="refresh" content="5; url= modificaProfesor.php">
                    <?php
                }
            } 
        }
    }
    else{
        echo "<h1> Has de estar validado para ver esta página </h1>";
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

