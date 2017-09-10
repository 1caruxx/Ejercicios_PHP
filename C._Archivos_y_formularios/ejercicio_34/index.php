<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ejercicio 34</title>
</head>
<body>
    <form>
        $&emsp;<input type="number" name="nmbImporte" placeholder="Ingrese el importe" required />
        <input type="submit" value="Calcular total" /><br/><br/>
    </form>
    <?php

        require "funciones.php";

        if(@$_REQUEST["nmbImporte"]) {

            echo "El total de su compra es: ".CalcularTotal($_REQUEST["nmbImporte"]);
        }
    ?>
</body>
</html>