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

        function borrarEmpleado($eliminar,$conexion){

            $sql = "DELETE FROM empleados WHERE Numero = $eliminar";

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