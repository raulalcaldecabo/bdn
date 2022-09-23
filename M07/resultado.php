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
                $sql = "SELECT * from cursos WHERE nombre LIKE '%".$_POST['buscador']."%'";
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
                    echo "<td> Codigo curso </td>";
                    echo "<td> Nombre </td>";
                    echo "<td> Descripción </td>";
                    echo "<td> Horas </td>";
                    echo "<td> Fecha Inicio </td>";
                    echo "<td> Fecha Final </td>";
                    echo "<td> Código Profesor </td>";
                    echo "</tr>";
                    $numlineas = mysqli_num_rows($consulta);
                    foreach($consulta as $curso => $campo){
                        echo "<tr>";
                        foreach($campo as $dato){
                            echo "<td> $dato </td>";
                        }
                        else{
                            echo "<td> <a href='modCursos.php?Numero=".$id."'> <img src='imagen/verde.png' width='80'></a> </td>";
                        }
                        echo "<td> <a href='modificarCurso.php?Numero=".$id."'> <img src='imagen/lapiz.png' width='80'></a> </td>";
                        
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