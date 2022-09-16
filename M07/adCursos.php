<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>administracion</title>
</head>
<body>
<?php 

include("funciones.php");

 // comprobamos si el usuario está conectado
 if(isset($_SESSION["rol"])){
    if($_SESSION["rol"] == 1){
        $linea = $_SESSION["usuario"];
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
        <h1>Añadir curso</h1>
        <form action="adCursos.php" method="POST"  name="dades">
            <table>
                 <tr>
                    <td>Código</td> 
                    <td><input type="text" name="codigoCurso" size="10" maxlength="20"><br/></td>
                </tr>
                <tr>
                    <td>Nombre</td>
                    <td> <input type="text" name="nombre" size="50" maxlength="9"></td>
                </tr>
                <tr>
                    <td>descripcion</td> 
                    <td><input type="text" name="descripcion" size="50" maxlength="50"><br/></td>
                </tr>
                <tr>
                    <td>Horas</td>
                    <td> <input type="text" name="Horas" size="50" maxlength="20"></td>
                </tr>
                <tr>
                    <td>Fecha inicio</td>
                    <td> <input type="text" name="fechaInicio" size="50" maxlength="20"></td>
                </tr>
                <tr>
                    <td>Fecha final</td>
                    <td> <input type="text" name="fechaFinal" size="50" maxlength="20"></td>
                </tr>
                <tr>
                    <td>profesor</td>
                    <td> <input type="text" name="profesor" size="50" maxlength="20"></td>
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