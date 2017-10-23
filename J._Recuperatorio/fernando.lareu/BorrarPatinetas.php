<?php

    require_once "./Patineta.php";

    $patinetas = Patineta::ObtenerPatinetasBD();
    $contador = 0;

    if(isset($_GET["marca"])) {

        foreach($patinetas as $item) {

            if($item->GetMarca() == $_GET["marca"]) {

                echo "Esta patineta esta cargada en las base de datos.";
                break;
            }

            $contador++;
        }

        if(count($patinetas) == $contador) {

            echo "Esta patineta no se ha cargado aun.";
        }
    }
    else {

        if(isset($_POST["marca"]) && $_POST["queDeboHacer"]=="borrar") {

            $datos = "mysql:host=localhost;dbname=recu";
            $user = "root";
            $pass = "";

            try {

                $conexcion = new PDO($datos , $user , $pass);
                $resultado = $conexcion->prepare("DELETE FROM `patinetas` WHERE `marca`='".$_POST["marca"]."'");
                $resultado->execute();

                foreach($patinetas as $item) {

                    if($item->GetMarca() == $_POST["marca"]) {

                        $arrayNombre = explode("." , $item->GetFoto());
                        $nombreFoto = $arrayNombre[0]."."."borrado".".".$arrayNombre[1].".".$arrayNombre[2];
                        $rutaFoto = "./patinetasBorradas/".$nombreFoto;

                        rename("./patinetasImagen/".$item->GetFoto() , $rutaFoto);
                    }
                }

                $conexcion = null;

                echo "Se ha borrado exitosamente.";
            }
            catch(PDOexception $excepcion) {

                echo "Atrapada una excepcion de tipo PDOexception: ".$excepcion->GetMessage();
            }
            catch(exception $excepcion) {

                echo "Atrapada otro tipo de excepcion: ".$excepcion->GetMessage();
            }
        }
    }
?>