<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="estilos/general.css">
    <title>Privacidad</title>
</head>
<body>
<?php 
include("funcionesBdn.php");

if(isset($_SESSION["rol"])){
    if($_SESSION["rol"] == 1 || $_SESSION["rol"] == 2 || $_SESSION["rol"] == 3){
       encabezado();
       navegacion();
       ?>
            <h1> Privacidad</h1>
            <p> La visita a este sitio Web no implica que el usuario esté obligado a facilitar ninguna información. En el caso de que el usuario facilite alguna información de carácter personal, los datos recogidos en este sitio web serán tratados de forma leal y lícita con sujeción en todo momento a los principios y derechos recogidos en el Reglamento (UE) 2016/679, de 27 de abril, General de Protección de Datos (RGPD) y demás normativa aplicable..</p>
            <p> La principal finalidad de dicho tratamiento es la gestión de los usuarios registrados en nuestra web, así como el envío de publicidad relativa a los productos y servicios comercializados por PcCOMPONENTES o para el envío de publicidad, descuentos y promociones de productos y servicios de otras entidades.PcCOMPONENTES asegura la confidencialidad de los datos aportados y garantiza que, en ningún caso, serán cedidos para ningún otro uso sin mediar consentimiento previo y expreso de nuestros usuarios. Sólo le pediremos aquellos datos necesarios para la prestación del servicio requerido y únicamente serán empleados para este fin.</p>
            <p>Al igual que indicamos en nuestra política de privacidad, la principal finalidad del tratamiento de los datos es mantener la relación contractual con nuestros clientes, facilitar la tramitación de los pedidos, la realización de estudios estadísticos, envío de publicidad relativa a los productos y servicios comercializados por PCCOMPONENTES o para el envío de publicidad, descuentos y promociones de productos y servicios de otras entidades, y además para el estudio de financiación de compras y obtención de créditos al consumo, así como para el descubrimiento y prevención del fraude, y minimización del riesgo de su comisión, en base al interés legítimo reconocido por la normativa vigente.</p>
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