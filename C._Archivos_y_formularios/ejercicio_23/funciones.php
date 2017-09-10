<?php

    function DeReversaMami($ruta){

        if(! $archivoOrigen = fopen($ruta , "r")){

            echo "No se pudo abrir el archivo";
        }else{

            $archivoDestino = fopen("./misArchivos/".date("Y_m_d_H_i_s").".txt" , "w");

            while(!feof($archivoOrigen)){

                fwrite($archivoDestino , strrev(trim(fgets($archivoOrigen)))."\r\n");
            }
        }
    }
?>