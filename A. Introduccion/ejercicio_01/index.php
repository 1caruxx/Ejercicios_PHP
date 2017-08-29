<?php

$condicion = true;
$numero = 1;
$contador = 0;

    while($condicion){

        if($numero <= 1000){
            
            echo $numero." - ";
        }
         else{
              $condicion = false;
              continue;
        }

        $numero += $contador+1;
        $contador++;
    }

    echo "<br/>Se han sumado: ", $contador, " numeros.";
?>