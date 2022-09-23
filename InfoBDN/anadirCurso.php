<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>anadir cursos</title>
</head>
<body>
<?php 

include("funciones.php");

// comprobamos si el usuario está conectado
if(isset($_SESSION["rol"])){
    if($_SESSION["rol"] == 1){
        echo "<form action = 'anadirCurso.php' method = 'POST' name = 'crear'>";
        echo "Codigo curso <input type = 'text' name = 'Numero'  size = '15' maxlength='30'></br>";
        echo "Nombre <input type = 'text' name = 'Nombre' size = '30' maxlength='30'> </br>";
        echo "Descripción <input type = 'text' name = 'Descripcion' size = 40' maxlength='100'> </br>";
        echo "Horas <input type = 'text' name = 'Horas' size = '15' maxlength='4'> </br>";
        echo "Fecha Inicio <input type = 'text' name = 'fechaInicio'  size = '15' maxlength='20'> </br>";
        echo "Fecha Final <input type = 'text' name = 'fechaFinal'  size = '15' maxlength='20'> </br>";
        echo "Código Profeso <input type = 'text' name = 'codigoProfesor'  size = '15' maxlength='20'></br>";
        echo "<input type='submit' name='crear' value='crear'>";
        echo "</form>";
        echo "</br>";
        echo "<a href='modCursos.php'> modificar cursos </a></br>";
        echo "<a href='modProf.php'> modificar profesores </a></br>";
        echo "<a href='destruirSesion.php'>Salir de la sesión</a>";
        

        if(isset($_POST['crear'])){
            //    $datos = $_REQUEST;
            $datos=$_POST['crear'];
            $BBDD="cursosbdn";
            $conexion = conectar($BBDD);
            if ($conexion == false){
                mysqli_connect_error();
            }
            else{
                $sql = "INSERT INTO cursos (codigoCurso, nombre, descripcion, horas, fechaInicio, fechaFinal, codigoProfesor) values ('$datos[0]', '$datos[1]', '$datos[2]', '$datos[3]' , '$datos[4]', '$datos[5]' ,'$datos[6]')";
                $consulta = mysqli_query($conexion, $sql);
                if ($consulta == false){
                    mysqli_error($conexion);
                }
                else{
                    $modificar = mysqli_query($conexion, $sql);
                    echo "<h1> Has creado el curso con éxito </h1>";
                }
            } 
            ?>
                <meta http-equiv="refresh" content="1; url= modCursos.php">
            <?php
        }  
    }
    else{
        echo "<h1> Has de estar validado para ver esta página </h1>";
    ?>
    <meta http-equiv="refresh" content="1; url=administrador.php">
    <?php  
    }     

}
else{
    echo "<h1> Has de estar validado para ver esta página </h1>";
    ?>
    <meta http-equiv="refresh" content="1; url=administrador.php">
    <?php  
}

?>
</body>
</html>