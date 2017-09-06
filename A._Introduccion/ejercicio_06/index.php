<?php

    $acumulador = 0;
    $contador = 0;
    $promedio;

    $array = array(rand(0, 10),rand(0, 10),rand(0, 10),rand(0, 10),rand(0, 10),rand(0, 10));
    var_dump($array);

    foreach($array as $item){
        $acumulador += $array[$contador];
        $contador++;
    }

    $promedio = $acumulador/6;

    if( $promedio < 6){
        echo "El promedio da menos que 6.";
    }
    else{
        if($promedio > 6){
            echo "El promedio es mayor a 6.";
        }
        else{
            echo "El promedio es 6.";
        }
    }
?>