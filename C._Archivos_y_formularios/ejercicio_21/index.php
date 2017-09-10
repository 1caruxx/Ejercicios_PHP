<?php

    $string = "";
    $arrayString = array();
    $archivo = fopen("./misArchivos/palabras.txt" , "r");
    $contador = 0;
    $contador2 = 0;
    $contador3 = 0;
    $contador4 = 0;
    $contador5 = 0;

    while(!feof($archivo)){

        $string .= " ".fgets($archivo);
    }

    $arrayString = explode(" " , $string);
    unset($arrayString[0]);
    var_dump($arrayString);
    echo "<br/>";

    foreach($arrayString as $item){

        switch(strlen(trim($item))){

            case 1:
                $contador++;
                break;

            case 2:
                $contador2++;
                break;

            case 3:
                $contador3++;
                break;

            case 4:
                $contador4++;
                break;

            default:
                $contador5++;
        }
    }

    fclose($archivo);

    echo "Palabras de una sola letra: ".$contador."<br/>Palabras de dos letras: ".$contador2."<br/>Palabras de tres letras: ".$contador3."<br/>Palabras de cuatro letras: ".$contador4."<br/>Palabras de 5 letras o mas: ".$contador5;
?>