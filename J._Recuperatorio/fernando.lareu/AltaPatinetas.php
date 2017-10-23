<?php

    require_once "./Patineta.php";

    $marca = $_POST["marca"];
    $precio = $_POST["precio"];
    $nombreFoto = $marca.".".date("Gis").".".pathinfo($_FILES["foto"]["name"] , PATHINFO_EXTENSION);
    $rutaFoto = "./patinetasImagen/".$nombreFoto;

    Patineta::GuardarEnBD(new Patineta($marca , $precio , $nombreFoto));

    move_uploaded_file($_FILES["foto"]["tmp_name"] , $rutaFoto);
?>