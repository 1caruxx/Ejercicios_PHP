<?php

    require_once "./Cd.php";
    try {
        
                        //sin espacios
        $datos = "mysql:host=localhost;dbname=cdcol";
        $user = "root";
        $pass = "";
        $conexcion = new PDO($datos , $user , $pass);
       
        //$resultados = $conexcion->query("SELECT * FROM cds");
        
        /*===================== fetchall() ====================*/

        /*
         * No se puede hacer varios fetch para la misma instancia.
         * Devuelve un array mixto entre asociativo e indexado
         */

        //$resultado = $resultados->fetchall();
        //var_dump($resultado);

        /*================== PDO::FETCH_ASSOC =================*/

        /*while($columna = $resultados->fetch(PDO::FETCH_ASSOC)) {

            echo "Titulo: ".$columna["titel"]."<br/>";
            echo "Interprete: ".$columna["interpret"]."<br/>";
            echo "Año: ".$columna["jahr"]."<br/>";
            echo "Identificacion: ".$columna["id"]."<br/><br/>";
        }*/

        /*=================== PDO::FETCH_NUM ==================*/

        /*while($columna = $resultados->fetch(PDO::FETCH_NUM)) {

            echo "Titulo: ".$columna[0]."<br/>";
            echo "Interprete: ".$columna[1]."<br/>";
            echo "Año: ".$columna[2]."<br/>";
            echo "Identificacion: ".$columna[3]."<br/><br/>";
        }*/
        
        /*=================== PDO::FETCH_OBJ ==================*/

        /*while($columna = $resultados->fetch(PDO::FETCH_OBJ)) {

            echo "Titulo: ".$columna->titel."<br/>";
            echo "Interprete: ".$columna->interpret."<br/>";
            echo "Año: ".$columna->jahr."<br/>";
            echo "Identificacion: ".$columna->id."<br/><br/>";
        }*/

        /*=================== fetchobject("") ==================*/

        //En los parametros del fetchobject van el nombre de mi clase.
        /*while($columna = $resultados->fetchobject("Cd")) {

            echo $columna->ToString()."<br/>";
        }*/

        /*================ Sentencias preparadas ===============*/

        $resultados = $conexcion->prepare("SELECT * FROM cds");
        $resultados->execute();

        /*============== Con parametros nombrados =============*/

        /*
        $resultados = $conexcion->prepare("SELECT * FROM cds WHERE id=:id");
        $resultados->execute(array("id"=>4));
        */

        /*
        $resultados = $conexcion->prepare("SELECT * FROM cds WHERE titel=:titel");
        $resultados->execute(array(":titel"=>"Glee"));
        */

        //Los atributos de la clase deberan ser publicos.
        $resultados->setFetchMode(PDO::FETCH_INTO, new cd);

        foreach($resultados as $item) {

            echo $item->ToString()."<br/>";
        }

        /*==================== bindparam() ===================*/

        $variable = 4;
        $bindeo = $conexcion->prepare("SELECT * FROM cds WHERE id=:id");;

        $bindeo->bindparam(":id" , $variable);
        $bindeo->setFetchMode(PDO::FETCH_INTO, new cd);
        $bindeo->execute();
        
        foreach($bindeo as $item) {

            echo $item->ToString()."<br/>";
        }
        
        $variable = 1;
        $bindeo->execute();

        foreach($bindeo as $item) {

            echo $item->ToString()."<br/>";
        }

        /*==================== bindvalue() ===================*/

        $variable2 = 4;
        $bindeo2 = $conexcion->prepare("SELECT * FROM cds WHERE id=:id");

        $bindeo2->bindvalue(":id" , $variable2);
        $bindeo2->setFetchMode(PDO::FETCH_INTO, new cd);
        $bindeo2->execute();
        
        foreach($bindeo2 as $item) {

            echo $item->ToString()."<br/>";
        }
        
        $variable2 = 1;
        $bindeo2->execute();

        foreach($bindeo2 as $item) {

            echo $item->ToString()."<br/>";
        }

        /*==================== bindcolumn() ===================*/

        $bindeo3 = $conexcion->prepare("SELECT * FROM cds");

        $bindeo3->bindcolumn(1, $variableTitulo);
        $bindeo3->bindcolumn(2, $variableInterprete);
        $bindeo3->bindcolumn(3, $variableAnio);
        $bindeo3->bindcolumn(4, $variableId);

        $bindeo3->execute();
        
        while($bindeo3->fetch(PDO::FETCH_ASSOC)) {

            echo "Titulo: ".$variableTitulo."<br/>";
            echo "Interprete: ".$variableInterprete."<br/>";
            echo "Año: ".$variableAnio."<br/>";
            echo "Identificacion: ".$variableId."<br/><br/>";
        }
    }
    catch(PDOexception $excepcion) {
        
        echo $excepcion->getmessage();
    }
?>