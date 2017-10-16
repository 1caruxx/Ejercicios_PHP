<?php

    require_once "./Helado.php";

    $sabor = strtolower($_POST["sabor"]);
    $precio = $_POST["precio"];
    $extension = pathinfo($_FILES["foto"]["name"] , PATHINFO_EXTENSION);
    $foto = $sabor.".".date("Gis").".".$extension;

    $helado = new Helado($sabor , $precio , $foto);

    Helado::Guardar($helado , $foto);
    move_uploaded_file($_FILES["foto"]["tmp_name"] , "./heladosImagen/".$foto);
?>