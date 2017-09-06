<?php

$array = array();
$i=1;
$contador=0;

while($contador < 10){

    if($i%2 != 0){

        $array[$contador] = $i;
        $contador++;
    }

    $i++;
}

var_dump($array);

echo "<br/><br/>for";

for($i=0;$i<10;$i++){

    echo "<br/>".$array[$i];
}

echo "<br/><br/>foreach";

foreach($array as $item){

    echo "<br/>".$item;
}

echo "<br/><br/>while";
$i = 0;

while($i < 10){

    echo "<br/>".$array[$i];
    $i++;
}
?>