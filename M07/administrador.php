<?php session_start(); ?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>administrador</title>
</head>

<body>
    <?php
    //Si usuario se ha conectado a la página se inicia este if 
    if($_REQUEST){
        $usuario = $_REQUEST["usuario"];
        $password = $_REQUEST["password"];
        //nos conectamos a la base de datos
        $conexion = mysqli_connect("Localhost", "root", "", "cursosbdn");
        if ($conexion == false){
            mysqli_connect_error();
        }
        else{
            //generamos la query
            $sql = "SELECT * from administrador where  pass = md5('$password')";
        }
        //la enviamos a la base de datos
        $consulta = mysqli_query($conexion, $sql);
        if ($consulta == false){
            mysqli_error($conexion);
        }
        $numlineas = mysqli_num_rows($consulta);
        $linea = mysqli_fetch_array($consulta);
        //comprobamos los datos del usuario con la base de datos y los guardamos como sesión
        $prueba = md5($password);
        if($linea[0] == $usuario && $prueba == $linea[1]){
            $_SESSION["usuario"] = $linea;
            $_SESSION["rol"] = 1;
        ?>
            <meta http-equiv="refresh" content="0; url= administracion.php">
        <?php
        }
        //si los datos son incorrectos vuelve a mandar al usuario al login
        else{
            echo 'Usuario o contraseña incorrectos';
            ?>
            <meta http-equiv="refresh" content="5; url= landpage.php">
            <?php
        }
    }
    //si usuario entra nuevo a la página se encuentra el formulario de login.
    else{
        ?>
        <h1>Administrador</h1>
        <form action="administrador.php" method="POST"  name="dades">
            <table>
                <tr>
                    <td>email</td> 
                    <td>
                        <input type="text" name="usuario" size="50" maxlength="15"><br/>
                    </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>
                        <input type="password" name="password" size="50" maxlength="9">
                    </td>
                </tr>
            </table>
            <br/>
            <div class="pie">
                <input type="submit" name="entrar" value="Entrar">
                <input type="reset" value="borrar">
            </div>                   
        </form>
        <?php
    } 
    ?> 
</body>
</html>