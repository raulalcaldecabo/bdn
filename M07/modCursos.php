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
        if(isset($_GET['Numero'])){
            $eliminar = $_GET['Numero'];
            $BBDD = "cursosbdn";
            $conexion = conectar($BBDD);
            if ($conexion == false){
                mysqli_connect_error();
            }
            else{
                //funcion para borrar un curso
                borrarCurso($eliminar, $conexion);
                ?>
                    <meta http-equiv="refresh" content="0; url= modCursos.php">
                    <?php
            }
        }
        
        else{
            $BBDD="cursosbdn";
            $linea = $_SESSION["usuario"];
            $cursos = consultaCursos($BBDD);
            $profes = consultaProfes($BBDD);
            $numlineas = mysqli_num_rows($cursos);
            echo "<h1> Cursos BDN </h1>";
            echo "<form action = modcursos.php method = 'POST' name = 'Borrado'>";
            echo "<table>";
            echo "<tr>";
            echo "<th>Código</th>";
            echo "<th>Nombre</th>";
            echo "<th>Descripción</th>";
            echo "<th>Horas</th>";
            echo "<th>Inicio</th>";
            echo "<th>Final</th>";
            echo "<th>Profesor</th>";
            echo "<th>Editar</th>";
            echo "<th>Eliminar</th>";
            echo "</tr>";
            foreach($cursos as $curso => $campo){
                $id=$campo["DNI"];
                echo "<tr>";
                foreach($campo as $dato){
                    echo "<td> $dato </td>";
                }
                
                if($campo["Activo"]==0){
                    echo "<td> <a href='modCursos.php?Numero=".$id."'> <img src='imagen/papelera.png' width='80'></a> </td>"; 
                }
                else{
                    echo "<td> <a href='modCursos.php?Numero=".$id."'> <img src='imagen/verde.png' width='80'></a> </td>";
                }
                echo "<td> <a href='modificarCurso.php?Numero=".$id."'> <img src='imagen/lapiz.png' width='80'></a> </td>";
                
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
            echo "<a href='anadirCurso.php'> añadir curso </a></br>";
            echo "<a href='modProf.php'> modificar profesores </a></br>";
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