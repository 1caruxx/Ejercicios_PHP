<?php

    var_dump($_FILES);
    move_uploaded_file($_FILES["fArchivo"]["tmp_name"] , "./Archivos/".$_FILES["fArchivo"]["name"]);

?>