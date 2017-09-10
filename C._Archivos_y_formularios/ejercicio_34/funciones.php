<?php

    function CalcularTotal($importe) {

        if($importe>=300 && $importe<=550) {

            $importe -= ($importe*10)/100;
        }
        else {

            if($importe > 500) {

                $importe -= ($importe*20)/100;
            }
        }

        return $importe;
    }
?>