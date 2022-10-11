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
            <h1> Particulares</h1>
            <p> Domina las tecnologías más demandadas por las empresas y certifica tus conocimientos con nuestro sistema de evaluación. Haz que tu currículum demuestre tu talento.</p>
            <p> Certifica tus conocimientos Valida las habilidades IT que ya tienes y las que conseguirás con nuestros cursos. Demuestra tus capacidades con nuestros certificados.</p>
            <p>Accede a carreras Completa alguna de las carreras que hemos diseñado y conviértete en un experto.</p>
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