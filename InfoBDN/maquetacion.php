<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>maquetacion</title>
</head>
    <body>
        <?php
        //El encabezado de casi todas las páginas
        function encabezado(){
            ?>
            <header>
                <img alt="logo" src="imagen/Logo.png" width = "150px" heigth= "150px"/>
                <h1>INFOBDN, ENCANTADOS DE FORMARTE</h1>
                <a href="destruirSesion.php">
                    <button class="admin">Salir de la sesión.</button>
                </a>
            </header>   
            <?php 
        }

        function navegacion(){
            if($_SESSION["rol"] == 2){
                echo "<a href='consultarCursos.php'> consultar cursos </a></br>";
            echo "<a href='modificarAlumno.php'>Editar alumno</a></br>";
            echo "<a href='fotoAlumno.php'>Editar foto alumno</a></br>";
            echo "<a href='alumnoFrontal.php'>página principal</a></br>";
            
            }
        }
        ?>
    </body>
</html>