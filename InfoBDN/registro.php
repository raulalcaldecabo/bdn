<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>validacion</title>
</head>

<body>
    <?php
    if($_REQUEST){
        $email = $_REQUEST["email"];
        $password = $_REQUEST["password"];
        $nombre = $_REQUEST["nombre"];
        $idioma1 = $_REQUEST["IdiomaNativo"];
        $idioma2 = $_REQUEST["idiomaAprender"];
        //nos conectamos a la base de datos
        $conexion = mysqli_connect("Localhost", "root", "", "lingua");
        if ($conexion == false){
            mysqli_connect_error();
        }
        else{
            //generamos la query para saber si está en la base de datos
            $sql = "SELECT * from usuarios where  email = '$email'";
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
            <meta http-equiv="refresh" content="5; url= registro.php">
            <?php
        }
        //si no existe lo ingresamos en la base de datos
        else{
            $sql2 = "INSERT INTO usuarios (email, password, nombre, IdiomaNativo, idiomaAprender) values('$email', $password, '$nombre', '$idioma1', '$idioma2') ";
            $consulta = mysqli_query($conexion, $sql2);
            if ($consulta == false){
                mysqli_error($conexion);
            }
            
            echo 'Enhora buena ya puedes acceder a Lingua';
            ?>
            <meta http-equiv="refresh" content="5; url= validacion.php">
            <?php
        }
        mysqli_close($conexion);    
    }
    //si usuario entra nuevo a la página se encuentra el formulario de login.
    else{
        ?>
    <h1>Registro Lingua</h1>
    <form action="registro.php" method="POST"  name="dades">
        <table>
             <tr>
                <td>mail</td> 
                <td><input type="text" name="email" size="50" maxlength="20"><br/></td>
            </tr>
            <tr>
                <td>Password</td>
                <td> <input type="password" name="password" size="50" maxlength="9"></td>
            </tr>
            <tr>
                <td>Nom</td> 
                <td><input type="text" name="nombre" size="50" maxlength="15"><br/></td>
            </tr>
            <tr>
                <td>idioma nativo</td>
                <td> <input type="text" name="IdiomaNativo" size="50" maxlength="20"></td>
            </tr>
            <tr>
                <td>idioma a practicar</td>
                <td> <input type="text" name="idiomaAprender" size="50" maxlength="20"></td>
            </tr>               
        </table>
        <br/>
        <div class="pie">
            <input type="submit" name="registrarse" value="registrarse">
            <input type="reset" value="reset">
        </div>                   
    </form>
    <?php
    } 
    ?> 
</body>
</html>