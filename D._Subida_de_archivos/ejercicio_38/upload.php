<?php

    $numero = count(scandir("./img"))-1;

    if(isset($_FILES["foto"])) {

        for($i=0 ; $i<count($_FILES["foto"]["name"]) ; $i++) {

            $esValida = true;
            $pesaMucho = false;

            if($_FILES["foto"]["size"][$i] > 90000) {

                echo "<br/>No se ha podido subir el archivo: ".$_FILES["foto"]["name"][$i]." por que pesa demasiado";
                $pesaMucho = true;
                $esValida = false;
            }

            if($_FILES["foto"]["type"][$i]!="image/jpg" && $_FILES["foto"]["type"][$i]!="image/jpeg") {

                if($pesaMucho) {

                    echo " y solo son soportadas las extensiones JPG y JPEG.<br/>";
                }
                else {

                    echo "No se ha podido subir el archivo: ".$_FILES["foto"]["name"][$i]." por que solo son soportadas las extensiones JPG y JPEG.<br/>";
                    $esValida = false;
                }
            }

            if($esValida) {

                move_uploaded_file($_FILES["foto"]["tmp_name"][$i] , "./img/img".$numero.".jpg");
                echo "<br/>Se ha cargado correctamente la foto: ".$_FILES["foto"]["name"][$i];
                $numero++;
            }
        }
    }

    echo "<br/><br/><a href='./'><input type='button' value='Volver'></a>";
?>