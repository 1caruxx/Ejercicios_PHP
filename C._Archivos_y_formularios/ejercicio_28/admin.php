<?php

    require "funciones.php";

    if(@$_REQUEST["rdoEntrada"] == "perimetro") {

        echo "El perimetro del rectangulo es: ".calcularperimetro($_REQUEST["nmbBase"] , $_REQUEST["nmbAltura"]);
    }
    else {
        
        if(@$_REQUEST["rdoEntrada"] == "area") {

            echo "El area del rectangulo es: ".calculararea($_REQUEST["nmbBase"] , $_REQUEST["nmbAltura"]);
        }
        else {}
    }

    echo "<br/><br/><a href='./?nmbBase=".$_REQUEST["nmbBase"]."&nmbAltura=".$_REQUEST["nmbAltura"]."&rdoEntrada=".$_REQUEST["rdoEntrada"]."'><input type='button' value='Volver' /></a>";
?>