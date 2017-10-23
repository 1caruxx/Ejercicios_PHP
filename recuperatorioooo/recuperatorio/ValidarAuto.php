<?php

    require_once "./Auto.php";

    $patente = $_POST["patente"];
    $marca = $_POST["marca"];
    $autos = Auto::ObtenerAutos();
    $contador = 0;

    //var_dump($clientes);

    foreach($autos as $item) {

        if($item->GetPatente()==$patente && $item->GetMarca()==$marca) {

            echo "Auto existente.\n
                  Patente: ".$item->GetPatente()."\n
                  Marca: ".$item->GetMarca()."\n
                  Color: ".$item->GetColor();
            break;
        }

        $contador++;
    }

    if(count($autos) == $contador) {

        echo "Auto inexistente.";
    }
?>