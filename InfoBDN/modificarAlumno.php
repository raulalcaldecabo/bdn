<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>principal alumno</title>
</head>
<body>
<?php 

include("funcionesBdn.php");

// comprobamos si el usuario está conectado
if(isset($_SESSION["rol"])){
    if($_SESSION["rol"] == 2){
        $usuario = $_SESSION["alumno"];
        $id = $usuario[0];
        $nombre = $usuario[2];
        $apellido = $usuario[3];

        if(isset($_POST['modificarAlumno'])){
            $DNI = $_POST['DNI'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $mail = $_POST['mail'];
            $id = $_POST['ID'];

            $BBDD="infobdn";
            $conexion = conectar($BBDD);
            if ($conexion == false){
                mysqli_connect_error();
            }
            else{
                $sql = "UPDATE alumnos  SET dni= '$DNI', nombre= '$nombre', apellido= '$apellido', mail = '$mail'  WHERE ID = '$id'";
                $consulta = mysqli_query($conexion, $sql);
                if ($consulta == false){
                    mysqli_error($conexion);
                 }
                else{
                    $modificar = mysqli_query($conexion, $sql);
                }
            }
            ?>
                <meta http-equiv="refresh" content="1; url= alumnoFrontal.php">
            <?php
            
        }
        else{
            //nos conectamos a la base de datos
            $BBDD ='infobdn';
            $alumno= modificarAlumno($BBDD,$id);    
            $numlineas = mysqli_num_rows($alumno);
            $linea = mysqli_fetch_array($alumno);
        
            //formulario de modificación profesor
            echo "<form action = 'modificarAlumno.php' method = 'POST' name = 'modificarAlumno'>";
            echo "Editar alumno </br>";
            echo "ID <input type = 'hidden' name = 'ID' value = '$linea[0]' size = '3' maxlength='3'></br>";
            echo "DNI <input type = 'text' name = 'DNI' value = '$linea[1]' size = '8' maxlength='8'> </br>";
            echo "nombre <input type = 'text' name = 'nombre' value = '$linea[2]' size = '50' maxlength='50'> </br>";
            echo "apellido <input type = 'text' name = 'apellido' value = '$linea[3]' size = '50' maxlength='50'> </br>";
            echo "mail <input type = 'text' name = 'mail' value = '$linea[4]' size = '100' maxlength='50'> </br>";
            echo "<input type='submit' value='modificar'>";
            echo "</form>";
            echo "</br>";
        
            echo "<h1> ¿Qué gestión deseas realizar? </h1></br>";
            echo "<a href='consultarCursos.php'> consultar cursos </a></br>";
            echo "<a href='editarAlumno.php'>Editar alumno</a></br>";
            echo "<a href='destruirSesion.php'>Salir de la sesión</a>";
        }
            
    }


    else{
        echo "<h1> No tienes permisos para ver esta página </h1>";
    }
}
else{
    echo "<h1> Has de estar validado para ver esta página </h1>";
}


?>
</body>
</html>