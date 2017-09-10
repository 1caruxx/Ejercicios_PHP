<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ejercicio 32</title>
</head>
<body>
    <form>
        <select name="slcDestino">
            <optgroup label="Destinos">
                <option value="1">Rio de Janeiro</option>
                <option value="2">Punta del Este</option>
                <option value="3">La Habana</option>
                <option value="4">Miami</option>
                <option value="5">Ibiza</option>
            </optgroup>
        </select>
        <input type="number" placeholder="Cantidad de pasajes" name="nmbPasajes" value="1" min="1"/><br/><br/>
        Medio de pago: <br/>
        <input type="radio" name="rdoPago" value="1">Efectivo</radio><br/>
        <input type="radio" name="rdoPago" value="2" checked>Tarjeta de credito o debito</radio><br/><br/>
        <input type="submit" value="Valor del viaje"/>
    </form><br/>
    <?php
        
        $valor = "";

        switch(@$_REQUEST["slcDestino"]) {

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

        if(@$_REQUEST["rdoPago"] == 2) {

            @$valor -= ($valor*7)/100;
        }
        else {

            @$valor -= ($valor*12)/100;
        }

        if(@$_REQUEST["nmbPasajes"] > 2) {

            $valor -= ($valor*35)/100;
        }

        if(@$_REQUEST["slcDestino"]) {

            echo "El valor del viaje es: ".$valor;
        }
    ?>
</body>
</html>