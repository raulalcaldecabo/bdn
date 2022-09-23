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
    
    echo "<form action = 'anadirProfesor.php' method = 'POST' name = 'crear'>";
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
    echo "<td> <input type = 'text' name = 'DNI'  size = '15' maxlength='30'> </td>";
    echo "<td> <input type = 'text' name = 'Nombre' size = '30' maxlength='30'> </td>";
    echo "<td> <input type = 'text' name = 'Apellido1' size = '100' maxlength='10'> </td>";
    echo "<td> <input type = 'text' name = 'Apellido2' size = '15' maxlength='4'> </td>";
    echo "<td> <input type = 'text' name = 'titulo'  size = '15' maxlength='20'> </td>";
    echo "<td> <input type = 'text' name = 'mail'  size = '15' maxlength='20'> </td>";
    echo "<td> <input type = 'text' name = 'pase'  size = '32' maxlength='20'> </td>";
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
            $sql = "INSERT profesores  SET DNI= '$datos[DNI]', nombre= '$datos[nombre]', apellido1=$datos[apellido1] , apellido2=$datos[apellido2], titulo=$datos[titulo] ,mail =$datos[mail]";
            if ($consulta == false){
                mysqli_error($conexion);
             }
            else{
                $modificar = mysqli_query($conexion, $sql);
            }
        }    
    }
    ?>
        <meta http-equiv="refresh" content="1; url= modProfs.php">
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