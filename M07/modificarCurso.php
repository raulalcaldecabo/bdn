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
    $consulta = modificarCursos($BBDD, $id);
    $profesor= consultaProfes($BBDD);      
    $numlineas = mysqli_num_rows($consulta);
    $linea = mysqli_fetch_array($consulta);
    
    echo "<form action = 'modificarCurso.php' method = 'POST' name = 'modificar'>";
    echo "<table>";
    echo "<tr>";
    echo "<td> Codigo curso </td>";
    echo "<td> Nombre </td>";
    echo "<td> Descripción </td>";
    echo "<td> Horas </td>";
    echo "<td> Fecha Inicio </td>";
    echo "<td> Fecha Final </td>";
    echo "<td> Código Profesor </td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td> <input type = 'hidden' name = 'Numero' value = '$linea[0]' size = '15' maxlength='30'> </td>";
    echo "<td> <input type = 'text' name = 'Nombre' value = '$linea[1]' size = '30' maxlength='30'> </td>";
    echo "<td> <input type = 'text' name = 'Descripcion' value = '$linea[2]' size = '15' maxlength='10'> </td>";
    echo "<td> <input type = 'text' name = 'Horas' value = '$linea[3]' size = '15' maxlength='4'> </td>";
    echo "<td> <input type = 'text' name = 'fechaInicio' value = '$linea[4]' size = '15' maxlength='20'> </td>";
    echo "<td> <input type = 'text' name = 'fechaFinal' value = '$linea[5]' size = '15' maxlength='5'> </td>";
    $total=mysqli_num_rows($profesor);
   
    echo "<td><select name = 'codigoProfesor'>";
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
            $sql = "UPDATE cursos  SET Nombre= '$datos[Nombre]', descripcion= '$datos[Descripcion]', horas=$datos[Horas] , fechaInicio=$datos[fechaInicio], fechaFinal=$datos[fechaFinal] ,codigoProfesor =$datos[codigoProfesor] WHERE codigoCurso = $datos[Numero]";
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
        <meta http-equiv="refresh" content="1; url= modCursos.php">
    <?php

}



?>

</body>
</html>

