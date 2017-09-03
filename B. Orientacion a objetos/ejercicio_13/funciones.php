<?php

    function ValidarPalabra($palabra , $max){

        $retorno = 0;
        $vecaux = str_split($palabra);

        if(count($vecaux) <= $max){

            echo "prueba";
            if(!strcmp($palabra, "Recuperatorio") || !strcmp($palabra, "Parcial") || !strcmp($palabra, "Programacion")){

                echo "prueba";
                $retorno = 1;
            }
        }

        return $retorno;
    }
?>