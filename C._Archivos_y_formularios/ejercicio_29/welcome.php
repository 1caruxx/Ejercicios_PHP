<?php

    if($_REQUEST["pswEntrada"] === $_REQUEST["pswConfirmacion"]) {

        echo "hola equisde";
    }
    else {

        header("Location: ./");
    }
?>