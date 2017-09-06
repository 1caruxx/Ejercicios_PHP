<?php

   /* $string = "Fernando Lareu";

    $ar = fopen("mi_archivo.txt" , "w");

    fwrite($ar , $string);


    fclose($ar);

    LeerArchivo("mi_archivo.txt");*/

   echo "<br/><br/>Cantidad de palabras de cinco letras: ".LeerArchivoEstadistica("estadistica.txt");

    function LeerArchivo($path){

       //@ este caracter delante de una funcion deshabilita los warnings
       if(!$ar = @fopen($path , "r")){

            echo "No se pudo abrir el archivo";
        }
        else{

            echo fread($ar , filesize($path));
        }

        fclose($ar);
    }

    //cuantas palabras de 5 letras encontro en ese archivo
    function LeerArchivoEstadistica($path){

        $string = "";
        $arrayString = array();
        $contador = 0 ;

        if(!$ar = fopen($path, "r")){

            echo "No se pudo abrir el archivo.";
        }
        else{

            while(!feof($ar)){

                $string .= " ".fgets($ar);
            }

            $arrayString = explode(" " , $string);
            var_dump($arrayString);

            foreach($arrayString as $item){

                //trim es una funcion que permite sacar caracteres especiales como el \n o el \r
                if(strlen(trim($item)) == 5){

                    $contador++;
                }
            }
        }

        return $contador;
    }
?>