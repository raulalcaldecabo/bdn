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
    if($_SESSION["rol"] == 1 || $_SESSION["rol"] == 3){
        if(isset($_GET['Numero'])){
            $_SESSION['ID'] = $_GET['Numero'];
            $id = $_GET['Numero'];
            echo "<form action = 'fotoProfesor.php' method = 'POST' name = 'foto' ENCTYPE = 'multipart/form-data'>";
            echo "<input type = 'hidden' name = 'Numero' value = '$id' size = '3' maxlength='3'></br>";
            echo "foto <input type = 'file' name = 'foto'> </br>";
            echo "<input type='submit' name='enviar' value='enviar'>";
            echo "</form>";
        }
        if(isset($_FILES['foto'])){
            $id = $_SESSION['ID'];
            if(is_uploaded_file($_FILES['foto']['tmp_name'])){
                $nombreDirectorio = "imagen/";
                $idUnico = $id;
                $nombreFichero = $idUnico . "-" .$_FILES['foto']['name'];
                $directorio= $nombreDirectorio.$nombreFichero;
                move_uploaded_file ($_FILES['foto']['tmp_name'], $nombreDirectorio.$nombreFichero);
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

                $sql = "UPDATE profesores SET pfoto = '$directorio' WHERE ID = '".$id."'";
                $consulta = mysqli_query($conexion, $sql);
                if ($consulta == false){
                    mysqli_error($conexion);
                }
                else{
                    $modificar = mysqli_query($conexion, $sql);
                    echo "<h1> Modificación realizada con éxito </h1>";
                    if($_SESSION["rol"] == 1){
                        ?>
                            <meta http-equiv="refresh" content="0; url= modificarProfesor.php">
                        <?php
                    }
                    if($_SESSION["rol"] == 3){
                        ?>
                            <meta http-equiv="refresh" content="0; url= profesorFrontal.php">
                        <?php
                    }
                    
                }
            } 
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

