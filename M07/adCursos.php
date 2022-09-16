<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>administracion</title>
</head>
<body>
<?php 

include("funciones.php");

if(isset($_POST["idCursos"])){
    $delete = $_POST["idCursos"];
    $cantidad = count($delete);
    //nos conectamos a la base de datos
    $conexion = mysqli_connect("Localhost", "root", "", "cursos");
    if ($conexion == false){
        mysqli_connect_error();
    }
    else{
        //generamos la query
        $sql1 = "SELECT * from cursos";
        //la enviamos a la base de datos
        $consulta = mysqli_query($conexion, $sql1);
        if ($consulta == false){
            mysqli_error($conexion);
        }
        else{
            $numlineas = mysqli_num_rows($consulta);
            //funcion para iterar mostrando los cursos borrados 
            mostrarBorrados($consulta,$delete);
            // convierto el array en un String separado por , así si son 1000 registros no debo hacer un for each y es más eficiente
            $delete = implode(",",$delete);
            //aquí aplico en el paréntesis los números con, para ser más eficiente.
            $sql = "DELETE FROM cursos WHERE Numero IN ($delete)";
            $borrado = mysqli_query($conexion, $sql);
            echo "<h2> Se han borrado $cantidad cursos </h2>";
            echo "<br/>";
            echo "<a href='adCursos.php'>Volver a la tabla de cursos</a>";
        }
    }
}

else if(isset($_GET['Numero'])){
    $eliminar = $_GET['Numero'];
    $conexion = mysqli_connect("Localhost", "root", "", "empresa");
    if ($conexion == false){
        mysqli_connect_error();
    }
    else{
        //funcion para borrar un curso
        borrarEmpleado($eliminar, $conexion);
        ?>
            <meta http-equiv="refresh" content="0; url= adCursos.php">
            <?php
    }
}

else{
    //nos conectamos a la base de datos
    $conexion = mysqli_connect("Localhost", "root", "", "cursosbdn");
    if ($conexion == false){
        mysqli_connect_error();
    }
    else{
        //generamos la query
        $sql = "SELECT * from cursos";
        //la enviamos a la base de datos
        $consulta = mysqli_query($conexion, $sql);
        if ($consulta == false){
            mysqli_error($conexion);
        }
        else{
            $numlineas = mysqli_num_rows($consulta);
            echo "<h1> Cursos BDN </h1>";
            echo "<form action = Borrar.php method = 'POST' name = 'Borrado'>";
            echo "<table>";
            echo "<tr>";
            echo "<th>Eliminar</th>";
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

            foreach($consulta as $curso => $campo){
                $id=$campo["codigoCurso"];
                echo "<tr>";
                echo "<td> <input type='checkbox' name='idCursos[]' value ='$id'> </td>";
                foreach($campo as $dato){
                    echo "<td> $dato </td>";
                }
                echo "<td> <a href='modificarCurso.php?Numero=".$id."'> <img src='imagen/lapiz.png' width='80'></a> </td>";
                echo "<td> <a href='borrarCurso.php?Numero=".$id."'> <img src='imagen/papelera.png' width='80'></a> </td>";
                echo "</tr>";
            }

            echo "<tr>";
            echo "</tr>";
            echo "</table>";
            echo "<input type='submit' value='eliminar'>";
            echo "</form>";
        }

    }

}


?>
</body>
</html>