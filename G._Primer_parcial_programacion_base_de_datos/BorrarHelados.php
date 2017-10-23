<?php

    require_once "./Helado.php";

    $helados = Helado::ObtenerHeladosBD();
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

            $datos = "mysql:host=localhost;dbname=parcial";
            $user = "root";
            $pass = "";

            try {

                $conexcion = new PDO($datos , $user , $pass);
                $resultado = $conexcion->prepare("DELETE FROM `helados` WHERE `_sabor`='".$_POST["sabor"]."'");
                $resultado->execute();

                foreach($helados as $item) {

                    if($item->getSabor() == $_POST["sabor"]) {

                        $arrayNombre = explode("." , $item->GetImagen());
                        array_unshift($arrayNombre , $item->getSabor());
                        $arrayNombre[1] = "borrado";
                        $nombreImagen = $arrayNombre[0].".".$arrayNombre[1].".".$arrayNombre[2].".".$arrayNombre[3];
                        $rutaImagen = "./heladosBorrados/".$nombreImagen;

                        rename("./heladosImagen/".$item->GetImagen() , $rutaImagen);
                    }
                }

                $conexcion = null;

                echo "Se ha borrado exitosamente.";
            }
            catch(PDOexception $excepcion) {

                echo "Atrapada una excepcion de tipo PDOexception: ".$excepcion->GetMessage();
            }
            catch(exception $excepcion) {

                echo "Atrapada otro tipo de excepcion: ".$excepcion->GetMessage();
            }
        }
    }
?>