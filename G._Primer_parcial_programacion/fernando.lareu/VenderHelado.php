<?php

    require_once "./Helado.php";

    $sabor = strtolower($_GET["sabor"]);
    $cantidad = $_GET["cantidad"];
    
    if($sabor!="chocolate" && $sabor!="vainilla") {

        return "No se ha encontrado el sabor";
    }
    else {

        $precio = 11.00;
        $helado = new Helado($sabor , $precio);

        return $helado->PrecioMasIva()*$cantidad;
    }
?>