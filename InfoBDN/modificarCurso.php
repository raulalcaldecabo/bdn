<?php session_start(); ?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>modificarCurso</title>
</head>

<body>   
<?php

include("funcionesBdn.php");

// comprobamos si el usuario está conectado
if(isset($_SESSION["rol"])){
    if($_SESSION["rol"] == 1){
        if(isset($_GET['Numero'])){
            $id = $_GET['Numero'];
            $BBDD="infobdn";
            //nos conectamos a la base de datos
            $consulta = modificarCursos($BBDD, $id);
            $profesor= consultaProfes($BBDD);      
            $numlineas = mysqli_num_rows($consulta);
            $linea = mysqli_fetch_array($consulta);
            $total=mysqli_num_rows($profesor);
            
            //formulario de modificación curso
            echo "<form action = 'modificarCurso.php' method = 'POST' name = 'modificar'>";
            echo "Editar curso </br>";
            echo "Codigo curso <input type = 'hidden' name = 'Numero' value = '$linea[0]' size = '3' maxlength='3'></br>";
            echo "Nombre <input type = 'text' name = 'nombre' value = '$linea[1]' size = '50' maxlength='50'></br>";
            echo "Descripción <input type = 'text' name = 'descripcion' value = '$linea[2]' size = '100' maxlength='100'></br>";
            echo "Duración <input type = 'text' name = 'duracion' value = '$linea[3]' size = '11' maxlength='11'></br>";
            echo "Inicio <input type = 'text' name = 'inicio' value = '$linea[4]' size = '10' maxlength='10'></br>";
            echo "final <input type = 'text' name = 'final' value = '$linea[5]' size = '10' maxlength='10'></br>";
            echo "Profesor <select name = 'profesor'></br>";
            for($i=0; $i<$total;$i++){
                $fila = mysqli_fetch_array($profesor);
                if($fila[0]==$linea[6]){
                    echo "<option selected= 'selected' value=".$fila[0].">".$fila[1]."</option>";
                }
                else{
                    echo "<option value=".$fila[0].">".$fila[1]."</option>";
                }
            }
            echo "</select>";
            echo "<input type='submit' value='modificar'>";
            echo "</form>";
            echo "</br>";
            echo "<a href='adminCursos.php'> Administrar cursos </a></br>";
            echo "<a href='adminProf.php'> Administrar profesores </a></br>";
            echo "<a href='destruirSesion.php'>Salir de la sesión</a>";     

        }
        else{
            if(isset($_POST)){
                $nombre = $_POST['nombre'];
                $descripcion = $_POST['descripcion'];
                $duracion = $_POST['duracion'];
                $inicio = $_POST['inicio'];
                $final = $_POST['final'];
                $profesor = $_POST['profesor'];
                $id = $_POST['Numero'];
                $BBDD="infobdn";
                $conexion = conectar($BBDD);
                if ($conexion == false){
                    mysqli_connect_error();
                }
                else{
                    $sql = "UPDATE cursos  SET nombre= '$nombre', descripcion= '$descripcion', duracion='$duracion' , inicio='$inicio', final='$final' ,profesor ='$profesor' WHERE ID = '$id'";
                    $consulta = mysqli_query($conexion, $sql);
                    if ($consulta == false){
                        mysqli_error($conexion);
                    }
                }    
            }
            ?>
                <meta http-equiv="refresh" content="1; url= adminCursos.php">
            <?php
        
        }
        
    }
    else{
        echo "<h1> Has de estar validado para ver esta página </h1>";
        ?>
            <meta http-equiv="refresh" content="5; url= landpage.php">
        <?php
    } 
} 
else{
    echo "<h1> Has de estar validado para ver esta página </h1>";
    ?>
        <meta http-equiv="refresh" content="5; url= landpage.php">
    <?php
}



?>

</body>
</html>

