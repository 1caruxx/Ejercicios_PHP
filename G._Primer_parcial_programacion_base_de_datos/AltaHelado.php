<?php

    require_once "./Helado.php";

    $sabor = strtolower($_POST["sabor"]);
    $precio = $_POST["precio"];
    $nombreImagen = $sabor.".".date("Gis").".".pathinfo($_FILES["imagen"]["name"] , PATHINFO_EXTENSION);
    $rutaImagen = "./heladosImagen/".$nombreImagen;

    Helado::GuardarEnBD(new Helado($sabor , $precio , $nombreImagen));

    move_uploaded_file($_FILES["imagen"]["tmp_name"] , $rutaImagen);
?>