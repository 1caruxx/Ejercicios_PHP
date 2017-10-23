<?php

    require_once "./Patineta.php";

    $patinetas = array();

    if(isset($_POST["marca"])) {

        $condicion = "`marca`='".$_POST["marca"]."'";
        $patinetas = Patineta::ObtenerPatinetasBD($condicion);

        foreach($patinetas as $item) {

            echo "Marca: ".$item->getmarca().
                 "\nPrecio: ".$item->getprecio().
                 "\nNombre de la foto: ".$item->getfoto()."\n\n";  
        }
    }
    else {

        if(isset($_GET["precio"])) {

            $condicion = "`precio`<='".$_GET["precio"]."'";
            $patinetas = Patineta::ObtenerPatinetasBD($condicion);

            foreach($patinetas as $item) {
                
                echo "Marca: ".$item->getmarca().
                     "\nPrecio: ".$item->getprecio().
                     "\nNombre de la foto: ".$item->getfoto()."\n\n";  
            }
        }
        else {
            echo "POST marca: muestra todas las patinetas cuya marca coincida.\n
                  GET precio: muestra todas las patinetas cuyo precio sea inferior o igual.";
        }
    }
?>