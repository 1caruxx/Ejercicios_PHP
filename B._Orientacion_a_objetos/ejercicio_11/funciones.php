<?php

    function CalcularPotencias(){

        for($i=1 ; $i<5 ; $i++){

            for($j=1 ; $j<5 ; $j++ ){

                echo pow($i, $j)." - ";
            }

            echo "<br/>";
        }
    }
?>