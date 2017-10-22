<?php

    require_once "./Helado.php";

    $helados = Helado::ObtenerHelados();
    $contador = 0;

    if(isset($_GET["sabor"])) {

        foreach($helados as $item) {

            if($item->getSabor() == $_GET["sabor"]) {

                echo "Este sabor fue cargado.";
                break;
            }

            $contador++;
        }

        if(count($helados) == $contador) {

            echo "Este sabor no se ha cargado aun.";
        }
    }
    else {

        if(isset($_POST["sabor"]) && $_POST["queDeboHacer"]=="borrar") {

            if(!@ $archivo = fopen("./heladosArchivo/helados.txt" , "w")) {

                echo "No se ha podido abrir el archivo.";
            }
            else {

                foreach($helados as $item) {

                    if($item->getSabor() == $_POST["sabor"]) {

                        $arrayNombre = explode("." , $item->GetImagen());
                        array_unshift($arrayNombre , $item->getSabor());
                        $arrayNombre[1] = "borrado";
                        $nombreImagen = $arrayNombre[0].".".$arrayNombre[1].".".$arrayNombre[2].".".$arrayNombre[3];
                        $rutaImagen = "./heladosBorrados/".$nombreImagen;

                        echo $rutaImagen;

                        rename("./heladosImagen/".$item->GetImagen() , $rutaImagen);

                        unset($helados[$contador]);
                    }

                    if(isset($helados[$contador])) {

                        fwrite($archivo , $item->toString());
                    }

                    $contador++;
                }
            }
        }
    }
?>