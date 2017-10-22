<?php

    require_once "./Helado.php";

    $sabor = $_POST["sabor"];
    $precio = $_POST["precio"];
    $helados = Helado::ObtenerHelados();
    $nombreImagen = $sabor.".".date("Gis").".".pathinfo($_FILES["imagen"]["name"] , PATHINFO_EXTENSION);
    $rutaImagen = "./heladosImagen/".$nombreImagen;
    $contador = 0;
    $encontrado = false;

    $helado = new Helado($sabor , $precio , $nombreImagen);

    if(!@ $archivo = fopen("./heladosArchivo/helados.txt" , "w")) {

        echo "No se ha podido abrir el archivo.";
    }
    else {

        foreach($helados as $item) {

            if($item->GetSabor() == $sabor) {

                unlink("./heladosImagen/".$item->GetImagen());
                move_uploaded_file($_FILES["imagen"]["tmp_name"] , $rutaImagen);
                $helados[$contador] = $helado;

                $encontrado = true;
                echo "Se ha modificado correctamente.";
            }

            if(isset($helados[$contador])) {

                fwrite($archivo , $helados[$contador]->ToString());
            }

            $contador++;
        }

        if(!$encontrado) {

            echo "El sabor ".$sabor." no se ha cargado todavia.";
        }
    }
?>