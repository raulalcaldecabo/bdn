<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="estilos/general.css">
    <title>anadir profesor</title>
</head>
<body>
<?php 

include("funcionesBdn.php");

// comprobamos si el usuario está conectado
if(isset($_SESSION["rol"])){
    if($_SESSION["rol"] == 1){
        if(isset($_POST['crear'])){
            $DNI = $_POST['DNI'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $titulo = $_POST['titulo'];
            $mail = $_POST['mail'];
            $contrasena = $_POST['contrasena'];
            
            if(is_uploaded_file($_FILES['foto']['tmp_name'])){
                $nombreDirectorio = "imagen/";
                $idUnico = $id;
                $nombreFichero = $idUnico . "-" .$_FILES['foto']['name'];
                $directorio= $nombreDirectorio.$nombreFichero;
                move_uploaded_file ($_FILES['foto']['tmp_name'], $nombreDirectorio.$nombreFichero);
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
                $sql = "INSERT INTO profesores (dni, nombre, apellido, titulo, mail, contrasena, activo, pfoto) values ('$DNI', '$nombre', '$apellido', '$titulo', '$mail', md5('$contrasena') ,'1', '$directorio')";
                $consulta = mysqli_query($conexion, $sql);
                if ($consulta == false){
                    mysqli_error($conexion);
                }
                else{
                    echo "<h1> Has creado el profesor con éxito </h1>";
                }
            } 
            ?>
                <meta http-equiv="refresh" content="10; url= adminProf.php">
                <?php
        }
        else{
            encabezado();
            navegacion();

            $BBDD="infobdn";
            echo "<form class='formulario' action = 'anadirProfesor.php' method = 'POST' name = 'crear'>";
            echo "DNI <input type = 'text' name = 'DNI'  size = '8' maxlength='8'> </br>";
            echo "Nombre <input type = 'text' name = 'nombre' size = '50' maxlength='50'> </br>";
            echo "Apellido <input type = 'text' name = 'apellido' size = '50' maxlength='50'> </br>";
            echo "titulo <input type = 'text' name = 'titulo' size = '100' maxlength='100'> </br>";
            echo "mail <input type = 'text' name = 'mail' size = '100' maxlength='100'> </br>";
            echo "contrasena <input type = 'text' name = 'contrasena' size = '35' maxlength='35'> </br>";
            echo "foto <input type = 'file' name = 'foto' accept = '.png, .jpg, jepg'> </br>";
            echo "<input type='submit' name='crear' value='crear'>";
            echo "</form>";
            echo "</br>";
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