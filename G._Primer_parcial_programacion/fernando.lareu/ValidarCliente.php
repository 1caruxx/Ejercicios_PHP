<?php

    require_once "./Cliente.php";

    $correo = $_POST["correo"];
    $clave = $_POST["clave"];
    $clientes = Cliente::ObtenerClientes();
    $contador = 0;

    foreach($clientes as $item) {

        if($item->GetCorreo()==$correo && $item->getClave()==$clave) {

            echo "Cliente logeado: ".$item->getNombre();
            break;
        }

        $contador++;
    }

    if(count($clientes) == $contador) {

        echo "Cliente inexistente.";
    }
?>