<?php

    function InvertirArray($vector){

        $vecAux = array();

        for($i=0 ; $i<count($vector) ; $i++){

            $vecAux[$i] = $vector[count($vector)-1-$i];
        }

        return $vecAux;
    }
?>