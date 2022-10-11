<?php session_start(); ?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="estilos/general.css">
    <title>modificarProfesor</title>
</head>

<body>   
<?php

include("funcionesBdn.php");

// comprobamos si el usuario está conectado
if(isset($_SESSION["rol"])){
    if($_SESSION["rol"] == 1|| $_SESSION["rol"] == 3){
        if(isset($_GET['Numero'])){
            $id = $_GET['Numero'];
            $BBDD="infobdn";
            if($_SESSION["rol"] == 1){
                encabezado();
                navegacion();
            }
            if($_SESSION["rol"] == 3){
                encabezado();
                navegacion();
            }
            //nos conectamos a la base de datos
            $profesor= modificarProfesor($BBDD,$id);    
            $numlineas = mysqli_num_rows($profesor);
            $linea = mysqli_fetch_array($profesor);
        
            //formulario de modificación profesor
            echo "<form class='formulario' action = 'modificarProfesor.php' method = 'POST' name = 'modificarProfesor'>";
            echo "<h2>Editar profesor</h2> </br>";
            echo "<input type = 'hidden' name = 'ID' value = '$linea[0]' size = '3' maxlength='3'></br>";
            echo "DNI <input type = 'text' name = 'DNI' value = '$linea[1]' size = '8' maxlength='8'> </br>";
            echo "nombre <input type = 'text' name = 'nombre' value = '$linea[2]' size = '50' maxlength='50'> </br>";
            echo "apellido <input type = 'text' name = 'apellido' value = '$linea[3]' size = '50' maxlength='50'> </br>";
            echo "titulo <input type = 'text' name = 'titulo' value = '$linea[4]' size = '100' maxlength='50'> </br>";
            echo "mail <input type = 'text' name = 'mail' value = '$linea[5]' size = '100' maxlength='50'> </br>";
            echo "<input type='submit' value='modificar'>";
            echo "</form>";
            
            footer();
        }
        else{
            if(isset($_POST)){
                $DNI = $_POST['DNI'];
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $titulo = $_POST['titulo'];
                $mail = $_POST['mail'];
                $id = $_POST['ID'];

                $BBDD="infobdn";
                $conexion = conectar($BBDD);
                if ($conexion == false){
                    mysqli_connect_error();
                }
                else{
                    $sql = "UPDATE profesores  SET dni= '$DNI', nombre= '$nombre', apellido= '$apellido', titulo= '$titulo', mail = '$mail'  WHERE ID = '$id'";
                    $consulta = mysqli_query($conexion, $sql);
                    if ($consulta == false){
                        mysqli_error($conexion);
                     }
                    else{
                        $modificar = mysqli_query($conexion, $sql);
                    }
                }    
            }
            ?>
                <meta http-equiv="refresh" content="1; url= adminProf.php">
            <?php
        
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

