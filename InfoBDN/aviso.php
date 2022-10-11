<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="estilos/general.css">
    <title>Aviso Legal</title>
</head>
<body>
<?php 
include("funcionesBdn.php");

if(isset($_SESSION["rol"])){
    if($_SESSION["rol"] == 1 || $_SESSION["rol"] == 2 || $_SESSION["rol"] == 3){
       encabezado();
       navegacion();
       ?>
            <h1> Aviso Legal</h1>
            <p> En cumplimiento con el deber de información recogido en artículo 10 de la Ley 34/2002, de 11 de julio, de Servicios de la Sociedad de la Información y del Comercio Electrónico,le informamos:.</p>
            <p> PCCOMPONENTES con CIF B73347494, es una sociedad domiciliada a los efectos de la presente información en la Avda. Europa, Parcelas 2-5 y 2-6 Polígono Industrial Las Salinas, 30840 Alhama de Murcia, y es en la actualidad la encargada de la explotación, gestión y funcionamiento del sitio web www.pccomponentes.com. Otros datos de contacto que ponemos a su disposición: Centro de Soporte, Quiero enviar una consulta.</p>
            <p>PCCOMPONENTES está inscrita en el Registro de Aparatos Eléctricos y Eléctrónicos del Ministerio de Industria, Turismo y Comercio (RII-AEE) con el número 4992.</p>
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