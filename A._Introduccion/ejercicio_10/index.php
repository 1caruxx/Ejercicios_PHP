<?php

    $lapicera = array("color"=>"rojo","marca"=>"BIC","trazo"=>"grueso","precio"=>2.25);
    $lapicera2 = array("color"=>"verde","marca"=>"Mapped","trazo"=>"fino","precio"=>5.5);
    $lapicera3 = array("color"=>"azul","marca"=>"Fabercastell","trazo"=>"grueso","precio"=>10.25);

    $lapiceras = array($lapicera, $lapicera2, $lapicera3);
    $lapiceras2 = array("lapicera1"=>$lapicera, "lapicera2"=>$lapicera2, "lapicera3"=>$lapicera3);

    var_dump($lapiceras);
    echo  "<br/><br/>";
    var_dump($lapiceras2);

   /* foreach($lapiceras as $item){
       
        var_dump($item);
        echo "<br/>";
    }*/
?>