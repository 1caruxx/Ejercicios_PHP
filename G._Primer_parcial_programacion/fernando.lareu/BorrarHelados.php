<?php

    $helados = Helado::TraerHelados();
    $contador = 0;

    if(isset($_GET["sabor"])) {

        foreach($helados as $item) {

            if($item->GetSabor() == $_GET["sabor"]) {

                echo "El sabor esta en el archivo.";
                break;
            }

            $contador++;
        }

        if($contador == count($helados)) {

            echo "El sabor no existe";
        }
    }
    else {

        if(isset($_POST["sabor"]) && $_POST["queDeboHacer"]=="borrar") {

            foreach($helados as $item) {

                if($item->GetSabor() == $_POST["sabor"]) {

                    $rutaFoto = $item->getfoto();
                }

            }

        }
    }
?>