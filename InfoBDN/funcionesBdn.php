<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>modificarEmpleado</title>
</head>

<body>
    <?php
        //Funcion para conectar a la base de datos
        function conectar($nombre){
            $conexion = mysqli_connect("Localhost", "root", "", $nombre);
            return $conexion;
        }
        //función para validar al administrador
        function validarAdmin($conexion,$usuario,$password){
            $correcto=0;
            $sql = "SELECT * from administrador where  pass = md5('$password')";
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta == false){
                mysqli_error($conexion);
            }
            $numlineas = mysqli_num_rows($consulta);
            $linea = mysqli_fetch_array($consulta);
            //comprobamos los datos del usuario con la base de datos y los guardamos como sesión
            $prueba = md5($password);
            if($linea[0] == $usuario && $prueba == $linea[1]){
                $_SESSION["usuario"] = $linea;
                $_SESSION["rol"] = 1;
                $correcto = 1;
            }
            return $correcto;
        }

        // query de todos los cursos
        function consultaCursos($nombre){
            $conexion = conectar($nombre);
            if ($conexion == false){
                mysqli_connect_error();
            }
            else{
                //generamos la query
                $sql = "SELECT * from cursos";
            }
            //la enviamos a la base de datos
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta == false){
                mysqli_error($conexion);
            }
            return $consulta;
        }

        //tabla de cursos de admincursos.php
        function tablaCursos($cursos){
            $numlineas = mysqli_num_rows($cursos);
            echo "<h1> Cursos BDN </h1>";
            echo "<table>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Nombre</th>";
            echo "<th>Descripción</th>";
            echo "<th>Duración</th>";
            echo "<th>Inicio</th>";
            echo "<th>Final</th>";
            echo "<th>Profesor</th>";
            echo "<th>Activo</th>";
            echo "<th>Mod. estado</th>";
            echo "<th>Modificar curso</th>";
            echo "</tr>";
            foreach($cursos as $curso => $campo){
                $id=$campo["ID"];
                echo "<tr>";
                foreach($campo as $dato){
                    echo "<td> $dato </td>";
                }
                if($campo['activo']=='0'){
                    echo "<td> $<a href=activarCursos.php?Numero=$id>Activar</a></td>";
                }
                else{
                    echo "<td> $<a href=desActivarCursos.php?Numero=$id>Desactivar</a></td>";
                }
                echo "<td> <a href='modificarCurso.php?Numero=".$id."'> <img src='imagen/lapiz.png' width='80'></a> </td>";
                echo "</tr>";
            }
            echo "</table>";
        }

        //busco el curso a modificar en la BBDD
        function modificarCursos($nombre, $curso){

            $conexion = conectar($nombre);
            if ($conexion == false){
                mysqli_connect_error();
            }
            else{
                //generamos la query
                $sql = "SELECT * from cursos WHERE ID = $curso";
                //la enviamos a la base de datos
            }    
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta == false){
                mysqli_error($conexion);
            }
        
            return $consulta; 
        }
        

        function suplantarprof($nombre, $curso){
            $conexion = conectar($nombre);
            if ($conexion == false){
                mysqli_connect_error();
            }
            else{
                //generamos la query
                $sql = "UPDATE cursos  SET codigoProfesor = 0 WHERE codigoProfesor = $curso";
                //la enviamos a la base de datos
            }    
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta == false){
                mysqli_error($conexion);
            }
        
            return $consulta;
            
        }
        function modificarProfesor($nombre, $curso){

            $conexion = conectar($nombre);
            if ($conexion == false){
                mysqli_connect_error();
            }
            else{
                //generamos la query
                $sql = "SELECT * from profesores WHERE DNI = $curso";
                //la enviamos a la base de datos
            }    
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta == false){
                mysqli_error($conexion);
            }
        
            return $consulta;
            
        }
        function consultaProfes($nombre){
            $conexion = conectar($nombre);
            if ($conexion == false){
                mysqli_connect_error();
            }
            else{
                //generamos la query
                $sql = "SELECT * from profesores";
            }
            //la enviamos a la base de datos
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta == false){
                mysqli_error($conexion);
            }
            return $consulta;
        }


        

        function mostrarBorrados($consulta,$delete){
            foreach($consulta as $persona => $campo){
                if(in_array($campo["Numero"], $delete)){
                    echo "<h1>Empleado borrado: </h1>";
                    foreach($campo as $dato){
                        echo "$dato";
                        echo "<br/>";
                    }
                }
            }
        }

        function borrarCurso($eliminar,$conexion){
            $sql = "DELETE FROM cursos WHERE codigoCurso = $eliminar";
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta == false){
                mysqli_error($conexion);
            }
            else{
                mysqli_query($conexion, $sql);
            }
        }

        function borrarProfesor($eliminar,$conexion){
            $sql = "DELETE FROM profesores WHERE DNI = $eliminar";
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta == false){
                mysqli_error($conexion);
            }
            else{
                mysqli_query($conexion, $sql);
            }
        }


    ?>

</body>