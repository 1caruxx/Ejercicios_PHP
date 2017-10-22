<?php

    require_once "./IVendible.php";

    class Helado implements Ivendible {

        private $_sabor;
        private $_precio;
        private $_imagen;

        public function GetSabor() {

            return $this->_sabor;
        }

        public function GetPrecio() {

            return $this->_precio;
        }
        public function GetImagen() {

            return $this->_imagen;
        }

        public function __construct($sabor , $precio , $imagen=null) {

            $this->_sabor = $sabor;
            $this->_precio = $precio;

            if($imagen && $imagen!="") {

                $this->_imagen = $imagen;
            }
        }

        public function PreciosMasIVA() {

            return $this->_precio*1.21;
        }

        public static function RetornarArrayDeHelados() {

            $helados = array();

            array_push($helados , new Helado("Chocolate" , 20));
            array_push($helados , new Helado("Vainilla" , 12.5));
            array_push($helados , new Helado("Frutilla" , 10));
            array_push($helados , new Helado("Menta" , 25));
            array_push($helados , new Helado("Guacamole" , 500));

            return $helados;
        }

        public function ToString() {

            return "{$this->_sabor} - {$this->_precio} - {$this->_imagen}\r\n";
        }

        public static function GuardarEnArchivo($objeto) {

            if(!@ $archivo = fopen("./heladosArchivo/helados.txt" , "a")) {

                echo "No se ha podido abrir el archivo.";
            }
            else {
                
                fwrite($archivo , $objeto->tostring());
                fclose($archivo);

                echo "Se ha cargado exitosamente.";
            } 
        }

        public static function ObtenerHelados() {

            $helados = array();
            $stringAux = "";

            if(!@ $archivo = fopen("./heladosArchivo/helados.txt" , "r")) {

                echo "No se ha podido abrir el archivo.";
            }
            else {

                while(!feof($archivo)) {

                    $stringAux =  trim(fgets($archivo));
                    $helado = explode(" - " , $stringAux);

                    if($helado[0] != "") {

                        array_push($helados , new Helado($helado[0] , $helado[1] , trim($helado[2])));
                    }
                }

                fclose($archivo);
                return $helados;
            }
        }
    }
?>