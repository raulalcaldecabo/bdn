<?php session_start(); ?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registro de alumnos</title>
</head>

<body>
    <?php
    include("funcionesBdn.php");
    
    if(isset($_REQUEST['crear'])){
        $dni = $_REQUEST['dni'];
        $nombre = $_REQUEST['nombre'];
        $apellido = $_REQUEST['apellido'];
        $mail = $_REQUEST['mail'];
        $contrasena = $_REQUEST['contrasena'];
        //nos conectamos a la base de datos
        $BBDD="infobdn";   
        $conexion = conectar($BBDD);
        if ($conexion == false){
            mysqli_connect_error();
        }
        else{
            $sql = "INSERT INTO alumnos (dni, nombre, apellido, mail, contrasena, activo) values ('$dni', '$nombre', '$apellido', '$mail', md5('$contrasena') ,'1')";
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta == false){
                mysqli_error($conexion);
            }
            else{
                 echo "<h1> Has creado el usuario con éxito </h1>";
            }
        } 
        ?>
            <meta http-equiv="refresh" content="0; url= landpage.php">
        <?php
    }
    //si usuario entra nuevo a la página se encuentra el formulario de login.
    else{
        $BBDD="infobdn";
            echo "<form action = 'registroAlumnos.php' method = 'POST' name = 'crear'>";
            echo "DNI <input type = 'text' name = 'DNI'  size = '8' maxlength='8'> </br>";
            echo "Nombre <input type = 'text' name = 'nombre' size = '50' maxlength='50'> </br>";
            echo "Apellido <input type = 'text' name = 'apellido' size = '50' maxlength='50'> </br>";
            echo "mail <input type = 'text' name = 'mail' size = '100' maxlength='100'> </br>";
            echo "contrasena <input type = 'text' name = 'contrasena' size = '35' maxlength='35'> </br>";
            echo "<input type='submit' name='crear' value='crear'>";
            echo "</form>";
    } 
    ?> 
</body>
</html>