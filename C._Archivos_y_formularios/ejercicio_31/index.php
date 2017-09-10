<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ejercicio 31</title>
</head>
<body>
    <form>
        <select name="slcEntrada">
            <optgroup label="Destinos">
                <option value="1">Rio de Janeiro</option>
                <option value="2">Punta del Este</option>
                <option value="3">La Habana</option>
                <option value="4">Miami</option>
                <option value="5">Ibiza</option>
            </optgroup>
        </select>
        <input type="submit" value="Valor del viaje"/>
    </form><br/>
    <?php
        
        $valor = "";

        switch(@$_REQUEST["slcEntrada"]) {

            case '1':
                $valor = "900€";
                break;

            case '2':
                $valor = "€550";
                break;

            case '3':
                $valor = "€1000";
                break;

            case '4':
                $valor = "€1250";
                break;

            case '5':
                $valor = "€1500";
        }

        if(@$_REQUEST["slcEntrada"]) {

            echo "El valor del viaje es: ".$valor;
        }
    ?>
</body>
</html>