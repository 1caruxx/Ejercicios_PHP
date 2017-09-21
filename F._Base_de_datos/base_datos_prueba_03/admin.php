<?php

    require "./funciones.php";

    $base = $_POST["base"];
    $tabla = $_POST["tabla"];

    $elementos = SELECT_TODO($base , $tabla);

    while($item = $elementos->fetch_object()){
        
        echo "Codigo de barra: {$item->codigo_barra}<br/>
        Nombre: {$item->nombre}<br/>
        Ruta: {$item->path_photo}<br/><br/>";
    }

    echo "<a href='./'><input type='button' value='Volver' /></a>";
?>