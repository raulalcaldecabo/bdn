<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="estilos/general.css">
    <title>buscador</title>
</head>
<body>
<?php 

include("funcionesBdn.php");

// comprobamos si el usuario está conectado
if(isset($_SESSION["rol"])){
    if($_SESSION["rol"] == 1){
        if(isset($_POST['buscador'])){
            $BBDD="infobdn";
            $conexion = conectar($BBDD);
            if ($conexion == false){
                mysqli_connect_error();
            }
            else{
                encabezado();
                navegacion();
                $sql = "SELECT * from cursos WHERE nombre LIKE '%".$_POST['buscador']."%'";
                $consulta = mysqli_query($conexion, $sql);
                if ($consulta == false){
                    mysqli_error($conexion);
                 }
                else{
                    $modificar = mysqli_query($conexion, $sql);
                }
                $numlineas = mysqli_num_rows($consulta);
                if($numlineas !=0){
                    echo "<table>";
                    echo "<tr>";
                    echo "<td> Codigo curso </td>";
                    echo "<td> Nombre </td>";
                    echo "<td> Descripción </td>";
                    echo "<td> Duración </td>";
                    echo "<td> Fecha Inicio </td>";
                    echo "<td> Fecha Final </td>";
                    echo "<td> Código Profesor </td>";
                    echo "<td> Activo </td>";
                    echo "<td> Foto </td>";
                    echo "</tr>";
                    $numlineas = mysqli_num_rows($consulta);
                    foreach($consulta as $curso => $campo){
                        $id=$campo["ID"];
                        $foto = $campo["cfoto"];
                        echo "<tr>";
                        foreach($campo as $dato){
                            if($dato == $foto){
                                echo "<td> <img width='50' height = '50' src = ".$foto." </td>";
                            }
                            else{
                                echo "<td> $dato </td>";
                            }
                        }
                        if($campo['activo']=='0'){
                            echo "<td> $<a href=estadoCurso.php?Numero=$id>Activar</a></td>";
                        }
                        else{
                            echo "<td> $<a href=estadoCurso.php?Numero=$id>Desactivar</a></td>";
                        }
                        echo "<td> <a href='modificarCurso.php?Numero=".$id."'> <img src='imagen/lapiz.png' width='30'></a> </td>";
                        echo "<td> <a href='fotoCurso.php?Numero=".$id."'> <img src='imagen/espejo.png' width='30'></a> </td>";
                        echo "</tr>";
                    }
                    footer();
                }
                else{
                    echo "<h1> No hay cursos que coincidan con esa busqueda </h1>";
                    ?>
                    <meta http-equiv="refresh" content="1; url= adminCursos.php">
                    <?php  

                }
            }    
        }     
    } 
    else{
        echo "<h1> No tienes permisos para ver esta página </h1>";
    }
    
}

else{
    echo "<h1> Has de estar validado para ver esta página </h1>";
}


?>
</body>
</html>