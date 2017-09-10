<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ejercicio 30</title>
</head>
<body>
    <form>
        <input type="checkBox" name="cbxDia" value="d">Dia</input><br/>
        <input type="checkBox" name="cbxMes" value="m">Mes</input><br/>
        <input type="checkBox" name="cbxAño" value="Y">Año</input><br/><br/>
        <input type="submit" value="Ver fecha actual" />
    </form><br/>
    <?php

        if(@$_REQUEST["cbxDia"] || @$_REQUEST["cbxMes"] || @$_REQUEST["cbxAño"]) {

            echo "La fecha actual es: ".date(@$_REQUEST["cbxDia"]." - ".@$_REQUEST["cbxMes"]." - ".@$_REQUEST["cbxAño"]);
        }
    ?>
</body>
</html>