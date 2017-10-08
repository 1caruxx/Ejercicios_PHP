<?php

    require_once "./Cd.php";
    try {
        
                        //sin espacios
        $datos = "mysql:host=localhost;dbname=cdcol";
        $user = "root";
        $pass = "";
        $conexcion = new PDO($datos , $user , $pass);
       
        $resultados = $conexcion->query("SELECT * FROM cds");

        //No se puede hacer varios fetch para la misma instancia.
        //devuelve un array mixto entre asociativo e indexado
        //$resultado = $resultados->fetchall();
        
        //var_dump($resultado);

        /*while($columna = $resultados->fetch(PDO::FETCH_ASSOC)) {

            echo "Titulo: ".$columna["titel"]."<br/>";
            echo "Interprete: ".$columna["interpret"]."<br/>";
            echo "Año: ".$columna["jahr"]."<br/>";
            echo "Identificacion: ".$columna["id"]."<br/><br/>";
        }*/
        
        //En los parametros del fetchobject van el nombre de mi clase
        while($columna = $resultados->fetchobject("Cd")) {

            echo $columna->ToString()."<br/>";
        }
    }
    catch(PDOexception $excepcion) {

        echo "hola";
        echo $excepcion->getmessage();
    }
?>