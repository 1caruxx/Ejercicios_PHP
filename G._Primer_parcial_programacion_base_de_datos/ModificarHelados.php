<?php

    require_once "./Helado.php";

    $sabor = $_POST["sabor"];
    $precio = $_POST["precio"];
    $helados = Helado::ObtenerHeladosBD();
    $nombreImagen = $sabor.".".date("Gis").".".pathinfo($_FILES["imagen"]["name"] , PATHINFO_EXTENSION);
    $rutaImagen = "./heladosImagen/".$nombreImagen;
    $encontrado = false;

    $datos = "mysql:host=localhost;dbname=parcial";
    $user = "root";
    $pass = "";

    try {

        foreach($helados as $item) {

            if($item->GetSabor() == $sabor) {

                $conexcion = new PDO($datos , $user , $pass);
                $resultado = $conexcion->prepare("UPDATE `helados` SET `_precio`={$precio},`_imagen`='{$nombreImagen}' WHERE `_sabor`='{$sabor}'");
                $resultado->execute();

                unlink("./heladosImagen/".$item->GetImagen());
                move_uploaded_file($_FILES["imagen"]["tmp_name"] , $rutaImagen);

                $encontrado = true;
                echo "Se ha modificado correctamente.";
            }
        }

        if(!$encontrado) {

            echo "El sabor ".$sabor." no se ha cargado todavia.";
        }
    }
    catch(PDOexception $excepcion) {
        
        echo "Atrapada una excepcion de tipo PDOexception: ".$excepcion->GetMessage();
    }
    catch(exception $excepcion) {

        echo "Atrapada otro tipo de excepcion: ".$excepcion->GetMessage();
    }
?>