<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="estilos/general.css">
    <title>poner nota</title>
</head>
<body>
<?php 

include("funcionesBdn.php");

// comprobamos si el usuario está conectado
if(isset($_SESSION["rol"])){
    if($_SESSION["rol"] == 3){
        $usuario = $_SESSION["profesor"];
        $id = $usuario[0];
        $nombre = $usuario[2];
        $apellido = $usuario[3];
        if(isset($_GET['Numero'])){
            $id= $_GET['Numero'];
            $BBDD="infobdn";
            encabezado();
            navegacion();

            $consulta = modificarAlumno($BBDD,$id);
            $linea = mysqli_fetch_array($consulta);
            echo "<h2> Selecciona la nota de ".$linea[2]." ".$linea[3]." </h2></br>";
            echo "<form class = 'formulario' action = 'ponerNota.php' method = 'POST' name = 'nota'>";
            echo "Nota <input type = 'text' name = 'nota' value = 'nota' size = '4' maxlength='4'> </br>";
            echo "<input type = 'hidden' name = 'ID' value = '$id' size = '3' maxlength='3'></br>";
            echo "<input type='submit' value='modificar'>";
            echo "</form>";

            footer();

        }
        else if(isset($_POST['nota'])){
            $id = $_POST['ID'];
            $nota = $_POST['nota'];
            $BBDD="infobdn";   
            $conexion = conectar($BBDD);
            if ($conexion == false){
                mysqli_connect_error();
            }
            else{
                $sql = "UPDATE matricula SET Nota = '$nota' WHERE idMatricula = '$id'"; 
                $consulta = mysqli_query($conexion, $sql);
                if ($consulta == false){
                    mysqli_error($conexion);
                }
                else{
                    echo "<h1> Has añadido la nota con éxito </h1>";
                }
            } 
            ?>
                <meta http-equiv="refresh" content="10; url= profesorFrontal.php">
                <?php
        }

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