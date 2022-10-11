<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="estilos/general.css">
    <title>Nosotros</title>
</head>
<body>
<?php 
include("funcionesBdn.php");

if(isset($_SESSION["rol"])){
    if($_SESSION["rol"] == 1 || $_SESSION["rol"] == 2 || $_SESSION["rol"] == 3){
       encabezado();
       navegacion();
       ?>
            <h1> Nosotros</h1>
            <p> Creemos en el buen karma, todo lo bueno que hacemos nos traerá consecuencias buenas, no entendemos que es el mal karma, porque no lo practicamos.</p>
            <p> Es una palabra sinojaponesa, que significa mejora continua. Nos invita a no dejar pasar un solo día sin aprender algo nuevo, la perseverancia es el mejor camino para entrenar nuestro cerebro.</p>
            <p>Los profesionales tecnológicos sois nuestro Kernel, el motor que hace que todo lo que hacemos cobre valor con el único objetivo de que podáis mejorar día a día.</p>
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