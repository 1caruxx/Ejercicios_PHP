<?php

    require_once "./Patineta.php";

    $marca = $_GET["marca"];
    $cantidad = $_GET["cantidad"];
    $patinetas = Patineta::RetornarArrayDePatinetas();
    $encontrado = false;

    foreach($patinetas as $item) {

        if($item->GetMarca() == $marca) {

            echo "Total a pagar: ".$item->PreciosMasIVA()*$cantidad;
            $encontrado = true;
            break;
        }
    }

    if(!$encontrado) {

        echo "La marca no existe.";

    }
?>