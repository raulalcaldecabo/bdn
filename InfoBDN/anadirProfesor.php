<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>anadir profesor</title>
</head>
<body>
<?php 

include("funciones.php");

// comprobamos si el usuario está conectado
if(isset($_SESSION["rol"])){
    if($_SESSION["rol"] == 1){
        if(isset($_POST['crearprof'])){
            $DNI = $_POST['DNI'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $titulo = $_POST['titulo'];
            $mail = $_POST['mail'];
            $contrasena = $_POST['contrasena'];
            $foto = "immagen/".$_POST['foto']."";
            

            if(is_uploaded_file()){
                $lugar = "immagen/";$_FILES['foto']['tmp_name'];
                $id = $DNI;
                $fichero = $id."-".$_FILES['foto']['tmp_name'];
                $directorio = $lugar.$fichero;
                move_uploaded_file($_FILES['foto']['tmp_name'],$lugar.$fichero);
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

                $sql = "INSERT INTO profesores (dni, nombre, apellido, titulo, mail, contrasena, activo, pfoto) values ('$DNI', '$nombre', '$apellido' , '$titulo', '$contrasena' ,'1', '$directorio')";
                $consulta = mysqli_query($conexion, $sql);
                if ($consulta == false){
                    mysqli_error($conexion);
                }
                else{
                    $modificar = mysqli_query($conexion, $sql);
                    echo "<h1> Has creado el profesor con éxito </h1>";
                }
            } 
            ?>
                <meta http-equiv="refresh" content="1; url= adminProf.php">
                <?php
        }
        else{
            $BBDD="infobdn";
            echo "<form action = 'anadirCurso.php' method = 'POST' name = 'crearprof'>";
            echo "DNI <input type = 'text' name = 'DNI'  size = '8' maxlength='8'> </td>";
            echo "Nombre <input type = 'text' name = 'nombre' size = '50' maxlength='50'> </br>";
            echo "Apellido <input type = 'text' name = 'apellido' size = '50' maxlength='50'> </br>";
            echo "titulo <input type = 'text' name = 'titulo' size = '100' maxlength='100'> </br>";
            echo "mail <input type = 'text' name = 'mail' size = '100' maxlength='100'> </br>";
            echo "contrasena <input type = 'text' name = 'contrasena' size = '35' maxlength='35'> </br>";
            echo "foto <input type = 'file' name = 'foto' accept = '.png, .jpg, jepg'> </br>";
            echo "Profesor <select name = 'profesor'></br>";
            echo "<input type='submit' name='crearprof' value='crearprof'>";
            echo "</form>";
            echo "</br>";
            echo "<a href='adminCursos.php'> Administrar cursos </a></br>";
            echo "<a href='adminProf.php'> Administrar profesores </a></br>";
            echo "<a href='destruirSesion.php'>Salir de la sesión</a>";
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