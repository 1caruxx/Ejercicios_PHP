<?php
    class Enigma{

        public static function Encriptar($path , $string){
            
            $stringEncriptado = "";

            for($i=0 ; $i<strlen($string) ; $i++){

                $stringEncriptado .=chr(ord(substr($string , $i))+200);
            }

            if(!$ar = @fopen($path , "w")){

                echo "No se pudo leer el archivo.";
            }
            else{

                fwrite($ar , $stringEncriptado);
            }

            fclose($ar);
        }

        public static function Desencriptar($path){
            
            if(! $ar = fopen())
        }
    }
?>