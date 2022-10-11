<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="estilos/general.css">
    <title>PArticulares</title>
</head>
<body>
<?php 
include("funcionesBdn.php");

if(isset($_SESSION["rol"])){
    if($_SESSION["rol"] == 1 || $_SESSION["rol"] == 2 || $_SESSION["rol"] == 3){
       encabezado();
       navegacion();
       ?>
            <h1> Centros educativos</h1>
            <p> ¿Para quién? Las BecasOW han sido diseñadas para profesores y estudiantes de tecnología que están muy cerca de acceder al mercado laboral. Universidad y Formación Profesional.</p>
            <p> ¿Cuánto tiempo? Las BecasOW son unas becas de formación de 10 meses de duración donde el beneficiario tendrá acceso ilimitado a todo el catálogo de cursos de OpenWebinars.</p>
            <p>¿Qué aprenderás? Las BecasOW dan acceso al mayor catálogo de cursos relacionados con tecnologías de programación y administración de sistemas más usadas por las empresas..</p>
       <?php 
       footer();
    }
   
}

//aunque sea la página de destruir sesión por seguridad no permito entrar aquí
else{
    echo "<h1> Has de estar validado para ver esta página </h1>";
    ?>
        <meta http-equiv="refresh" content="5; url= landpage.php">
        <?php
}
?>   
</body>
</html>