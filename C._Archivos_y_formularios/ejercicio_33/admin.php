<?php

    require "./Clases/Empleado.php";

    $empleado = new Empleado($_REQUEST["txtNombre"] , $_REQUEST["txtApellido"] ,$_REQUEST["nmbEdad"] , $_REQUEST["txtDireccion"] , $_REQUEST["emlMail"] , $_REQUEST["txaCurriculum"]);

    echo $empleado->ToString();
?>