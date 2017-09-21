<?php

    $host = "localhost";
    $user = "root";
    $pass = "";
    $base = "productos";

    $conecxion = new mysqli($host , $user , $pass , $base);

    if(!$conecxion) {

        echo "Se a producido un error...";
    }

    $insert = "INSERT INTO productos (nombre , path_photo) VALUES ('nuevo' , 'nosequeponer')";

    $conecxion->query($insert);

    $conecxion->close();
?>