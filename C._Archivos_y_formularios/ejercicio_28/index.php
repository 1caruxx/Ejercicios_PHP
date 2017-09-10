<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ejercicio 28</title>
</head>
<body>
    <form action="admin.php">
        <input type="number" placeholder="Ingrese la base" name="nmbBase" />
        <input type="number" placeholder="Ingrese la altura" name="nmbAltura" />
        <input type="submit" value="Calcular" /><br/><br/>
        <input type="radio" value="perimetro" name="rdoEntrada" checked>Calcular perimetro</input><br/>
        <input type="radio" value="area" name="rdoEntrada">Calcular area</input>
    </form>
    <?php

        require "./funciones.php";

        echo "<br/>";
        
        if(@$_REQUEST["rdoEntrada"] == "perimetro") {

            echo "El perimetro del rectangulo es: ".calcularperimetro($_REQUEST["nmbBase"] , $_REQUEST["nmbAltura"]);
        }
        else {

            if(@$_REQUEST["rdoEntrada"] == "area") {

                echo "El area del rectangulo es: ".calculararea($_REQUEST["nmbBase"] , $_REQUEST["nmbAltura"]);
            }
            else {}
        }
    ?>
</body>
</html>