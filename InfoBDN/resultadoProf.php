<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link type="text/css" rel="stylesheet" href="estilos/general.css">
    <title>buscador profesores</title>
</head>
<body>
<?php 

include("funcionesbdn.php");

// comprobamos si el usuario está conectado
if(isset($_SESSION["rol"])){
    if($_SESSION["rol"] == 1){
        if(isset($_POST['buscador'])){
            encabezado();
            navegacion();
            $BBDD="infobdn";
            $conexion = conectar($BBDD);
            if ($conexion == false){
                mysqli_connect_error();
            }
            else{
                $sql = "SELECT ID, dni, nombre, apellido, titulo, mail, activo, pfoto from profesores WHERE nombre LIKE '%".$_POST['buscador']."%'";
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
                    echo "<th>ID</th>";
                    echo "<th>DNI</th>";
                    echo "<th>Nombre</th>";
                    echo "<th>apellido1</th>";
                    echo "<th>titulo</th>";
                    echo "<th>mail</th>";
                    echo "<th>Activo</th>";
                    echo "<th>foto</th>";
                    echo "<th>Mod. estado</th>";
                    echo "<th>Modificar profesor</th>";
                    echo "<th>Modificar foto</th>";
                    echo "</tr>";
                    $numlineas = mysqli_num_rows($consulta);
                    foreach($consulta as $curso => $campo){
                        $id=$campo["ID"];
                        $foto = $campo["pfoto"];
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
                            echo "<td> $<a href=estadoProfesor.php?Numero=$id>Activar</a></td>";
                        }
                        else{
                            echo "<td> $<a href=estadoProfesor.php?Numero=$id>Desactivar</a></td>";
                        }
                        echo "<td> <a href='modificarProfesor.php?Numero=".$id."'> <img src='imagen/lapiz.png' width='30'></a> </td>";
                        echo "<td> <a href='fotoProfesor.php?Numero=".$id."'> <img src='imagen/espejo.png' width='30'></a> </td>";
                        echo "</tr>";
                    }

                }
                else{
                    echo "<h1> No hay cursos que coincidan con esa busqueda </h1>";
                    ?>
                    <meta http-equiv="refresh" content="1; url= adminProf.php">
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