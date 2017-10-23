<?php

    require_once "./Patineta.php";

    $marca = $_POST["marca"];
    $precio = $_POST["precio"];
    $patinetas = Patineta::ObtenerPatinetasBD();
    $nombreFoto = $marca.".".date("Gis").".".pathinfo($_FILES["foto"]["name"] , PATHINFO_EXTENSION);
    $rutaFoto = "./patinetasImagen/".$nombreFoto;
    $encontrado = false;

    $datos = "mysql:host=localhost;dbname=recu";
    $user = "root";
    $pass = "";

    try {

        foreach($patinetas as $item) {

            if($item->GetMarca() == $marca) {

                $conexcion = new PDO($datos , $user , $pass);
                $resultado = $conexcion->prepare("UPDATE `patinetas` SET `precio`={$precio},`path_foto`='{$nombreFoto}' WHERE `marca`='{$marca}'");
                $resultado->execute();

                unlink("./patinetasImagen/".$item->GetFoto());
                move_uploaded_file($_FILES["foto"]["tmp_name"] , $rutaFoto);

                $encontrado = true;
                echo "Se ha modificado correctamente.";
            }
        }

        if(!$encontrado) {

            echo "La patineta de marca ".$marca." no se ha cargado todavia.";
        }
    }
    catch(PDOexception $excepcion) {
        
        echo "Atrapada una excepcion de tipo PDOexception: ".$excepcion->GetMessage();
    }
    catch(exception $excepcion) {

        echo "Atrapada otro tipo de excepcion: ".$excepcion->GetMessage();
    }
?>