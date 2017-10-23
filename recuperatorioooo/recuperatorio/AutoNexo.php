<?php

    require_once "./Auto.php";

    $patente = $_GET["patente"];
    $marca = $_GET["marca"];
    $color = $_GET["color"];

    $auto = new Auto($patente , $marca , $color);

    Auto::GuardarEnArchivo($auto);

?>