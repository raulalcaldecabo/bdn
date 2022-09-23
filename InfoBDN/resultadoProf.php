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
        if(isset($_POST['buscador'])){
            $BBDD="cursosbdn";
            $conexion = conectar($BBDD);
            if ($conexion == false){
                mysqli_connect_error();
            }
            else{
                $sql = "SELECT * from profesores WHERE nombre LIKE '%".$_POST['buscador']."%'";
                $consulta = mysqli_query($conexion, $sql);
                if ($consulta == false){
                    mysqli_error($conexion);
                 }
                else{
                    $modificar = mysqli_query($conexion, $sql);
                }
                if($consulta !=0;){
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>DNI</th>";
                    echo "<th>Nombre</th>";
                    echo "<th>apellido1</th>";
                    echo "<th>apellido2</th>";
                    echo "<th>titulo</th>";
                    echo "<th>mail</th>";
                    echo "<th>pase</th>";
                    echo "<th>Editar</th>";
                    echo "<th>Eliminar</th>";
                    echo "</tr>";
                    $numlineas = mysqli_num_rows($consulta);
                    foreach($consulta as $curso => $campo){
                        echo "<tr>";
                        foreach($campo as $dato){
                            echo "<td> $dato </td>";
                        }
                        else{
                            echo "<td> <a href='modProf.php?Numero=".$id."'> <img src='imagen/verde.png' width='80'></a> </td>";
                        }
                        echo "<td> <a href='modificarProfesor.php?Numero=".$id."'> <img src='imagen/lapiz.png' width='80'></a> </td>";
                        
                        echo "</tr>";
                    }
                    echo "<a href='modCursos.php'> modificar cursos </a></br>";
                    echo "<a href='modProf.php'> modificar profesores </a></br>";
                    echo "<a href='destruirSesion.php'>Salir de la sesión</a>";

                }
                else{
                    echo "<h1> No hay cursos que coincidan con esa busqueda </h1>";
                    ?>
                    <meta http-equiv="refresh" content="1; url= modCursos.php">
                    <?php  

                }
            }    
        }     
    } 
}

else{
    echo "<h1> Has de estar validado para ver esta página </h1>";
}


?>
</body>
</html>