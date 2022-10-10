<?php session_start(); ?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="estilos/general.css">
    <title>registro de alumnos</title>
</head>

<body>
    <?php
    include("funcionesBdn.php");
    
    if(isset($_REQUEST['crear'])){
        $dni = $_REQUEST['DNI'];
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
            //generamos la query para saber si está en la base de datos
            $sql = "SELECT * from alumnos where  mail = '$mail'";
        }
        //la enviamos a la base de datos
        $consulta = mysqli_query($conexion, $sql);
        if ($consulta == false){
            mysqli_error($conexion);
        }
        //si existe el mail le informamos que está registrado y lo devolvemos a registro
        if(mysqli_num_rows($consulta)>0){
            echo 'Ese usuario ya está registrado';
            ?>
            <meta http-equiv="refresh" content="5; url= landpage.php">
            <?php
        }
        //si no existe lo ingresamos en la base de datos
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