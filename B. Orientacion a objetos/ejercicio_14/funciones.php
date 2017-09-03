<?php

    function EsPar($numero){

        $retorno = false;

        if($numero%2 == 0){

            $retorno = true;
        }

        return $retorno;
    }

    function EsImpar($numero){

        return !espar($numero);
    }
?>