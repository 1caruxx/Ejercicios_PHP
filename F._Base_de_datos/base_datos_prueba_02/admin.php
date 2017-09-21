<?php

    require "./funciones.php";

    $base = $_POST["base"];
    $tabla = $_POST["tabla"];
    $nombre = $_POST["nombre"];
    $ruta = $_POST["ruta"];

    insert($base , $tabla , $nombre , $ruta);

    header('Location: ./')
?>