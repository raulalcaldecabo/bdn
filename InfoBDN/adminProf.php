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

include("funcionesBdn.php");

// comprobamos si el usuario está conectado
if(isset($_SESSION["rol"])){
    if($_SESSION["rol"] == 1){
        if(isset($_GET['Numero'])){
            $BBDD = "infobdn";
            $eliminar = $_GET['Numero'];
            $conexion = conectar($BBDD);
            if ($conexion == false){
                mysqli_connect_error();
            }
            else{
                //funcion para borrar un profesor
                borrarProfesor($eliminar, $conexion);
                ?>
                    <meta http-equiv="refresh" content="0; url= adminProf.php">
                    <?php
            }
        }
        
        else{
            encabezado();
            navegacion();
            echo "<h1> Profes InfoBDN </h1>";

            //formulario buscador
            echo "<form action = 'resultadoProf.php' method = 'POST' name = 'buscador'>";
            echo "buscador:<input type='text' id='buscador' name='buscador' `placeholder='buscador'";
            echo "<button type='submit'>Buscar</button>";
            echo "</form>";
            
            $BBDD ="infobdn";

            $profes = consultaProfes($BBDD);
            tablaProfes($profes);
            $numlineas = mysqli_num_rows($profes);
    
           
            echo "<form>";
            echo "<form action = anadir.php method = 'POST' name = 'añadir'>";
            echo "<input type='submit' value='anadir'>";
            echo "</form>";
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