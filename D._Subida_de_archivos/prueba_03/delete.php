<?php

$ruta = $_GET["ruta"];
    unlink($ruta);

    echo "Se ha borrado exitosamente.";
    echo "<br/><a href='./upload.php'><input type='button' value='Volver' /></a>";
?>