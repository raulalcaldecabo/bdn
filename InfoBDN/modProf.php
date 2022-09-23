<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>modificar profesores</title>
</head>
<body>
<?php 

include("funciones.php");

// comprobamos si el usuario está conectado
if(isset($_SESSION["rol"])){
    if($_SESSION["rol"] == 1){
        if(isset($_GET['Numero'])){
            $BBDD = "cursosbdn";
            $eliminar = $_GET['Numero'];
            $conexion = conectar($BBDD);
            if ($conexion == false){
                mysqli_connect_error();
            }
            else{
                //cambiamos los cursos en los que está profesor a un comodin porque al ser una FK no podemos dejar un curso sin profe
                suplantarprof($conexion,$eliminar)
                //funcion para borrar un profesor
                borrarProfesor($eliminar, $conexion);
                ?>
                    <meta http-equiv="refresh" content="0; url= modProf.php">
                    <?php
            }
        }
        
        else{

            echo "<form action = 'resultadoProf.php' method = 'POST' name = 'buscador'>";
            echo "buscador:<input type='text' id='buscador' name='buscador' `placeholder='buscador'";
            echo "<button type='submit'>Buscar</button>";
            echo "</form>"
            
            $BBDD="cursosbdn";
            $linea = $_SESSION["usuario"];
            $profes = consultaProfes($BBDD);
            $numlineas = mysqli_num_rows($profes);
            echo "<h1> Cursos BDN </h1>";
            echo "<form action = modProf.php method = 'POST' name = 'Borrado'>";
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
            foreach($profes as $profe => $campo){
                $id=$campo["DNI"];
                echo "<tr>";
                foreach($campo as $dato){
                    echo "<td> $dato </td>";
                }
                echo "<td> <a href='modificarProfesor.php?Numero=".$id."'> <img src='imagen/lapiz.png' width='80'></a> </td>";
                echo "<td> <a href='modProf.php?Numero=".$id."'> <img src='imagen/papelera.png' width='80'></a> </td>";
                echo "</tr>";
            }
        
            echo "<tr>";
            echo "</tr>";
            echo "</table>";
            echo "</form>";
            echo "<form action = anadir.php method = 'POST' name = 'añadir'>";
            echo "<input type='submit' value='anadir'>";
            echo "</form>";
            echo "</br>";
            echo "<a href='modCursos.php'> modificar cursos </a></br>";
            echo "<a href='destruirSesion.php'>Salir de la sesión</a>";
        }        
        
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