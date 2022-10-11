<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="estilos/general.css">
    <title>empresas</title>
</head>
<body>
<?php 
include("funcionesBdn.php");

if(isset($_SESSION["rol"])){
    if($_SESSION["rol"] == 1 || $_SESSION["rol"] == 2 || $_SESSION["rol"] == 3){
       encabezado();
       navegacion();
       ?>
            <h1> Empresas</h1>
            <p> Cuida a tu talento,potencia sus habilidades La escasez de talento tecnológico hace que los profesionales sean los que eligen a las empresas donde quieren trabajar. Apuesta por un cambio en tu modelo formativo para atraer y fidelizar a los mejores perfiles IT..</p>
            <p> Contenido siempre actualizado Cada semana se suman nuevos cursos a nuestro catálogo. Nuestros profesores son expertos que trabajan día a día con las tecnologías que imparten.</p>
            <p>En sólo 6 meses hemos alcanzado el 75% de nuestro plan de formación anual. OpenWebinars ha supuesto un apoyo clave para llevar nuestro modelo formativo a un nivel superior.</p>
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