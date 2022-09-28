<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>anadir profesor</title>
</head>
<body>
<?php 

include("funcionesBdn.php");

// comprobamos si el usuario está conectado
if(isset($_SESSION["rol"])){
    if($_SESSION["rol"] == 3){
        
        echo "<h1> hola cabron </h1>";

    }
    else{
        echo "<h1> Has de estar validado para ver esta página </h1>";
    }
}
else{
    echo "<h1> Has de estar validado para ver esta página </h1>";
}


?>
</body>
</html>