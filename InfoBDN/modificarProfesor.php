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

include("funciones.php");
if(isset($_GET['Numero'])){
    $id = $_GET['Numero'];
    $BBDD="cursosbdn";
    //nos conectamos a la base de datos
    $profesor= modificarProfesor($BBDD,$id);      
    $numlineas = mysqli_num_rows($profesor);
    $linea = mysqli_fetch_array($profesor);

    
    echo "<form action = 'modificarProfesor.php' method = 'POST' name = 'modificar'>";
    echo "<table>";
    echo "<tr>";
    echo "<td> DNI </td>";
    echo "<td> Nombre </td>";
    echo "<td> Apellido1 </td>";
    echo "<td> Apellido2 </td>";
    echo "<td> título</td>";
    echo "<td> mail </td>";
    echo "<td> pase </td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td> <input type = 'text' name = 'DNI' value = '$linea[0]' size = '15' maxlength='30'> </td>";
    echo "<td> <input type = 'text' name = 'nombre' value = '$linea[1]' size = '30' maxlength='30'> </td>";
    echo "<td> <input type = 'text' name = 'apellido1' value = '$linea[2]' size = '15' maxlength='10'> </td>";
    echo "<td> <input type = 'text' name = 'apellido2' value = '$linea[3]' size = '15' maxlength='4'> </td>";
    echo "<td> <input type = 'text' name = 'titulo' value = '$linea[4]' size = '15' maxlength='20'> </td>";
    echo "<td> <input type = 'text' name = 'mail' value = '$linea[5]' size = '15' maxlength='5'> </td>";
    echo "<td> <input type = 'hidden' name = 'pase' value = '$linea[6]' size = '15' maxlength='5'> </td>";
    $total=mysqli_num_rows($profesor);
   
    echo "</td>";
    echo "</tr>";
    echo "</table>";
    echo "<input type='submit' value='modificar'>";
    echo "</form>";
    echo "</br>";
    echo "<a href='modCursos.php'> modificar cursos </a></br>";
    echo "<a href='modProf.php'> modificar profesores </a></br>";
    echo "<a href='destruirSesion.php'>Salir de la sesión</a>";     

}
else{
    if(isset($_POST)){
        //    $datos = $_REQUEST;
        $datos=$_POST;
        $BBDD="cursosbdn";
        $conexion = conectar($BBDD);
        if ($conexion == false){
            mysqli_connect_error();
        }
        else{
            $sql = "UPDATE profesores  SET DNI= '$datos[DNI]', nombre= '$datos[nombre]', apellido1=$datos[apellido1] , apellido2=$datos[apellido2], titulo=$datos[titulo] ,mail =$datos[mail] WHERE DNI = $datos[DNI]";
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta == false){
                mysqli_error($conexion);
             }
            else{
                $modificar = mysqli_query($conexion, $sql);
            }
        }    
    }
    ?>
        <meta http-equiv="refresh" content="1; url= modProf.php">
    <?php

}



?>

</body>
</html>

