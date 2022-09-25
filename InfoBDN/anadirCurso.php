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

include("funcionesBdn.php");

// comprobamos si el usuario está conectado
if(isset($_SESSION["rol"])){
    if($_SESSION["rol"] == 1){
        if(isset($_POST['crear'])){
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $duracion = $_POST['duracion'];
            $inicio = $_POST['inicio'];
            $final = $_POST['final'];
            $profesor = $_POST['profesor'];
            $BBDD="infobdn";
            $conexion = conectar($BBDD);
            if ($conexion == false){
                mysqli_connect_error();
            }
            else{

                $sql = "INSERT INTO cursos (nombre, descripcion, duracion, inicio, final, profesor) values ('$nombre', '$descripcion', '$duracion' , '$inicio', '$final' ,'$profesor')";
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
                <meta http-equiv="refresh" content="1; url= adminCursos.php">
                <?php
        }
        else{
            $BBDD="infobdn";
            $consulta= consultaProfes($BBDD);
            $numlineas = mysqli_num_rows($consulta);
            $linea = mysqli_fetch_array($consulta);
            $total=mysqli_num_rows($consulta);

            echo "<form action = 'anadirCurso.php' method = 'POST' name = 'crear'>";
            echo "Nombre <input type = 'text' name = 'nombre' size = '50' maxlength='50'> </br>";
            echo "Descripción <input type = 'text' name = 'descripcion' size = 100' maxlength='100'> </br>";
            echo "Horas <input type = 'text' name = 'duracion' size = '11' maxlength='11'> </br>";
            echo "Inicio <input type = 'text' name = 'inicio'  size = '10' maxlength='10'> </br>";
            echo "Final <input type = 'text' name = 'final'  size = '10' maxlength='10'> </br>";
            echo "Profesor <select name = 'profesor'></br>";
            
            for($i=0; $i<=$total;$i++){
                $fila = mysqli_fetch_array($consulta);
                echo "<option value=".$fila[0].">".$fila[1]."</option>";
            }
            echo "</select>";
            echo "</br>";
            echo "<input type='submit' name='crear' value='crear'>";
            echo "</form>";
            echo "</br>";
            echo "<a href='adminCursos.php'> Administrar cursos </a></br>";
            echo "<a href='adminProf.php'> Administrar profesores </a></br>";
            echo "<a href='destruirSesion.php'>Salir de la sesión</a>";
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