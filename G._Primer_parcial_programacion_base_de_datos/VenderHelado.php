<?php

    require_once "./Helado.php";

    $sabor = strtolower($_GET["sabor"]);
    $cantidad = $_GET["cantidad"];

    switch($sabor) {

        case 'chocolate':
        case 'vainilla':
        case 'frutilla':
        case 'menta':
        case 'guacamole':

            $helado = new Helado($sabor , 20);

            echo $helado->PreciosMasIVA()*$cantidad;
            break;
        
        default:
            echo "Sabor inexistente.";
    }
?>