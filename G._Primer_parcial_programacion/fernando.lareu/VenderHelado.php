<?php

    require_once "./Helado.php";

    $sabor = strtolower($_GET["sabor"]);
    $cantidad = $_GET["cantidad"];
    
    if($sabor!="chocolate" && $sabor!="vainilla") {

        return "No se ha encontrado el sabor";
    }
    else {

        $helado = new Helado($sabor , $cantidad);

        return $helado->PrecioMasIva();
    }
?>