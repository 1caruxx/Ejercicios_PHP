<?php

    require_once "./IVendible.php";

    class Helado implements IVendible{

        private $_sabor;
        private $_precio;
        private $_foto;

        public function GetSabor() {

            return $this->_sabor;
        }

        public function GetFoto() {
            
             return "./heladosImagen/".$this->_foto;
        }

        public function __construct($sabor , $precio , $foto = null) {

            $this->_sabor = $sabor;
            $this->_precio = $precio;
            $this->_foto = $foto;
        }

        public function PrecioMasIva() {

            return $this->_precio*1.21;
        }

        public static function RetornarArrayDeHelados() {

            $helados = array();

            array_push($helados , new Helado("Chocolate" , 2,5));
            array_push($helados , new Helado("Frutilla" , 5));
            array_push($helados , new Helado("Vainilla" , 4.5));
            array_push($helados , new Helado("Durazno" , 5));
            array_push($helados , new Helado("Guacamole" , 200));

            return $helados;
        }

        private function ToString()
        {

            return $this->_sabor." - ".$this->_precio." - ";
        }

        public static function Guardar($helado , $foto) {

            $retorno = false;

            if(!@$archivo = fopen("./heladosArchivo/helados.txt" , "a")) {

                echo "No se pudo abrir el archivo";
            }
            else {

                $cantidad = fwrite($archivo , $helado->ToString().$foto."\r\n");

                if($cantidad > 0) {

                    $retorno = true;
                }
                    
                fclose($archivo); 
            }

            return $retorno;
        }

        public static function TraerHelados() {
            
            if(!@$archivo = fopen("./heladosArchivo/helados.txt" , "r")) {
            
                  echo "no se ha podido leer el archivo";
            }
            else {

                while(!feof($archivo)) {

                    $archAux = fgets($archivo);
                    $helados = explode(" - ", $archAux);
                    $helados[0] = trim($helados[0]);
                    $helados[1] = trim($helados[1]);
                    $helados[2] = trim($helados[2]);
            
                    if($helados[0] != ""){

                        $listaDehelados[] = new Helado($helados[0] , $helados[1] , $helados[2]);
                    }
                }

                fclose($archivo);
                return $listaDehelados;
            }
        }
    }
?>