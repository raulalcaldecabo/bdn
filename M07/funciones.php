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
        function conectarBBDD($nombre){

            $server = "localhost";
            $user = "root";
            $pass = "";
            $bd = $nombre;
            $conexion = mysqli_connect("Localhost", "root", "", "cursos");
        
            $conexion = mysqli_connect($server, $user, $pass,$bd) 
                or die("Ha sucedido un error inexperado en la conexion de la base de datos");
        
            return $conexion;
        } 

        function desconectarBBDD($conexion){
            $close = mysqli_close($conexion) 
                or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
            return $close;
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


    ?>

</body>