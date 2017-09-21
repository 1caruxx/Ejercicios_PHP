<?php

    if(isset($_FILES["fArchivo"])) {

        $rutaAuxiliar = "./".$_FILES["fArchivo"]["name"];
        $extension = pathinfo($rutaAuxiliar , PATHINFO_EXTENSION);
        $esValido = true;

        switch($extension) {

            case "doc":

                doc:

                if($_FILES["fArchivo"]["size"] > 61440) {

                    echo "Los archivos con extension .doc o .docx no pueden exceder de los 60 KB.";
                    $esValido = false;
                }

                break;

            case "docx":
                goto doc;
                break;
            
            case "jpg":

                jpg: 

                if($_FILES["fArchivo"]["size"] > 307200) {

                    echo "Los archivos con extension .jpg, .jpeg o .gif no pueden exceder de los 300 KB.";
                    $esValido = false;
                }
                break;

            case "jpeg":
                goto  jpg;
                break;

            case "gif":
                goto jpg;
                break;

            default:
                
                if($_FILES["fArchivo"]["size"] > 512000) {

                    echo "Este archivo con extension: ".$extension." no debe pesar mas de 500 KB.";
                    $esValido = false;
                }
        }

        if($esValido) {

            move_uploaded_file($_FILES["fArchivo"]["tmp_name"] , "./Uploads/".date("Y-m-d").".".$extension);
            echo "Se ha subido correctamente el archivo.<br/>";
        }
    }
    else {

        echo "No se ha seleccionado ningun archivo.";
    }

    echo "<a href='./'><input type='button' value='Volver'></a>";
?>