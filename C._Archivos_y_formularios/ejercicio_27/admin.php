<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php

    require "funciones.php";

    echo "El perimetro del rectangulo es: ".CalcularPerimetro($_REQUEST["nmbBase"] , $_REQUEST["nmbAltura"]);
    echo "<br/";
    echo "<form>
            <a href='./?nmbBase=".$_REQUEST["nmbBase"]."&nmbAltura=".$_REQUEST["nmbAltura"]."'><input type='button' value='Volver' /></a>
          </form>";

?>
</body>
</html>