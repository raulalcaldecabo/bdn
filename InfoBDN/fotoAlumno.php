<?php session_start(); ?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="estilos/general.css">
    <title>cambiar foto alumno</title>
</head>

<body>   
<?php

include("funcionesBdn.php");

// comprobamos si el usuario está conectado
if(isset($_SESSION["rol"])){
    if($_SESSION["rol"] == 2){
        encabezado();
        navegacion();
        if(isset($_FILES['foto'])){
            $usuario = $_SESSION["alumno"];
            $id = $usuario[0];
            $nombre = $usuario[2];
            $apellido = $usuario[3];
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

                $sql = "UPDATE alumnos SET foto = '$directorio' WHERE ID = '".$id."'";
                $consulta = mysqli_query($conexion, $sql);
                if ($consulta == false){
                    mysqli_error($conexion);
                }
                else{
                    $modificar = mysqli_query($conexion, $sql);
                    echo "<h1> Modificación realizada con éxito </h1>";
                    ?>
                        <meta http-equiv="refresh" content="0; url= alumnoFrontal.php">
                    <?php
                }
            } 
        }
        else{
            $usuario = $_SESSION["alumno"];
            $id = $usuario[0];
            $nombre = $usuario[2];
            $apellido = $usuario[3];
            
            echo "<form class = 'formulario' action = 'fotoAlumno.php' method = 'POST' name = 'foto' ENCTYPE = 'multipart/form-data'>";
            echo "<input type = 'hidden' name = 'Numero' value = '$id' size = '3' maxlength='3'></br>";
            echo "Foto <input type = 'file' name = 'foto'> </br>";
            echo "<input type='submit' name='enviar' value='enviar'>";
            echo "</form>";
        }
        footer();
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

