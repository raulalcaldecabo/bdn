<?php session_start(); ?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>landpage</title>
    <link type="text/css" rel="stylesheet" href="landpage.css">

</head>

<body>
    <?php
    include("funcionesBdn.php");
    //Si usuario se ha conectado a la página se inicia este if 
    if($_REQUEST){
        $usuario = $_REQUEST["usuario"];
        $password = $_REQUEST["password"];
        $tipo = $_REQUEST["user"];
        //nos conectamos a la base de datos
        $BBDD = "infobdn";
        $conexion = conectar($BBDD);
        if ($conexion == false){
            mysqli_connect_error();
        }
        else{
            if ($tipo=="Alumno"){
                $correcto = validarAlumno($conexion, $usuario, $password);
                if($correcto ==1){
                    ?>
                    <meta http-equiv="refresh" content="1; url= alumnoFrontal.php">
                    <?php
                }
                else{
                    echo 'Usuario o contraseña incorrectos';
                    ?>
                    <meta http-equiv="refresh" content="5; url= landpage.php">
                    <?php
                }
            }
            else if($tipo=="Profesor"){
                $correcto = validarProfesor($conexion, $usuario, $password);
                if($correcto ==1){
                    ?>
                    <meta http-equiv="refresh" content="1; url= profesorFrontal.php">
                    <?php
                }
                else{
                    echo 'Usuario o contraseña incorrectos';
                    ?>
                    <meta http-equiv="refresh" content="5; url= landpage.php">
                    <?php
                }
            }
            else{
                echo 'Selecciona profesor o alumno';
                ?>
                <meta http-equiv="refresh" content="5; url= landpage.php">
                <?php
            }
        }
       
    }
    //si usuario entra nuevo a la página se encuentra el formulario de login.
    else{
        ?>
        <header>
            <img alt="logo" src="imagen/Logo.png" width = "150px" heigth= "150px"/>
            <h1>INFOBDN, ENCANTADOS DE FORMARTE</h1>
            <a href="administrador.php">
                <button class="admin">Panel admin.</button>
            </a>
        </header>
        
        <form class = "form" action="landpage.php" method="POST"  name="dades">
            DNI<input type="text" name="usuario" size="8" maxlength="8"><br/>
            Contraseña<input type="password" name="password" size="10" maxlength="10"> <br/>
            Alumno <input type="radio" name="user" value="Alumno">
            Profesor <input type="radio" name="user" value="Profesor"><br/>
            <div class="botones">
                <input type="submit" name="entrar" value="Entrar">
                <input type="reset" value="borrar">
            </div>
                           
        </form>
        
        <br/>
            <div>
                <!-- el enlace para ir al formulario de registro-->
                <a href="registroAlumnos.php">
                <button class="Registro">Registrarse</button></a>
            </div>    
        <?php
    } 
    ?> 
</body>
</html>