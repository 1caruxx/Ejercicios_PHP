<?php

    function CopiarArchivo($ruta){

        if(!copy($ruta , "./misArchivos/".date("Y_m_d_H_i_s").".txt")){

            echo "No se pudo copiar el archivo";
        }
    }
?>