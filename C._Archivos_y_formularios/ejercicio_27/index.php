<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ejercicio 27</title>
</head>
<body>
    <form action="./admin.php">
        <input type="number" placeholder="Ingrese la base" name="nmbBase" />
        <input type="number" placeholder="Ingrese la altura" name="nmbAltura" />
        <input type="submit" value="Calcular perimetro" /><br/><br/>
        <?php
            require "funciones.php";
            
            echo "El perimetro del rectangulo es: ".CalcularPerimetro(@$_REQUEST["nmbBase"] , @$_REQUEST["nmbAltura"]);
        ?> 
    </form>
</body>
</html>