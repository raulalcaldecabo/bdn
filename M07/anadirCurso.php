<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>modificar cursos</title>
</head>
<body>
<?php 

include("funciones.php");

// comprobamos si el usuario está conectado
if(isset($_SESSION["rol"])){
    if($_SESSION["rol"] == 1){
    
    echo "<form action = 'crearCurso.php' method = 'POST' name = 'crear'>";
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
    echo "<td> <input type = 'hidden' name = 'Numero'  size = '15' maxlength='30'> </td>";
    echo "<td> <input type = 'text' name = 'Nombre' size = '30' maxlength='30'> </td>";
    echo "<td> <input type = 'text' name = 'Descripcion' size = '100' maxlength='10'> </td>";
    echo "<td> <input type = 'text' name = 'Horas' size = '15' maxlength='4'> </td>";
    echo "<td> <input type = 'text' name = 'fechaInicio'  size = '15' maxlength='20'> </td>";
    echo "<td> <input type = 'text' name = 'fechaFinal'  size = '15' maxlength='20'> </td>";
    echo "<input type='submit' value='crear'>";
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
            $sql = "INSERT cursos  SET Nombre= '$datos[Nombre]', descripcion= '$datos[Descripcion]', horas=$datos[Horas] , fechaInicio=$datos[fechaInicio], fechaFinal=$datos[fechaFinal] ,codigoProfesor =$datos[codigoProfesor]";
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