<?php

    $numero = count(scandir("./img"))-1;

    move_uploaded_file($_FILES["foto"]["tmp_name"] , "./img/img".$numero.".jpg");

    echo "Se ha cargado correctame la foto.";
    echo "<br/><br/><a href='./'><input type='button' value='Volver'></a>";
?>