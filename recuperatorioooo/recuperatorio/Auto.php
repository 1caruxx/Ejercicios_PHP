<?php

    class Auto {

        private $_patente;
        private $_marca;
        private $_color;

        public function GetPatente() {

            return $this->_patente;
        }

        public function GetMarca() {

            return $this->_marca;
        }

        public function GetColor() {

            return $this->_color;
        }

        public function __construct($patente , $marca , $color) {

            $this->_patente = $patente;
            $this->_marca = $marca;
            $this->_color = $color;
        }

        public function ToString() {
            
            return "{$this->_patente} - {$this->_marca} - {$this->_color}\r\n";
        }

        public static function GuardarEnArchivo($auto) {

            if(!@ $archivo = fopen("./autos/autosActuales.txt" , "a")) {

                echo "No se ha podido abrir el archivo.";
            }
            else {
                
                fwrite($archivo , $auto->tostring());
                fclose($archivo);
                
                echo "Se ha cargado exitosamente.";
            }
        }

        public static function ObtenerAutos() {

            $autos = array();
            $stringAux = "";

            if(!@ $archivo = fopen("./autos/autosActuales.txt" , "r")) {

                echo "No se ha podido abrir el archivo.";
            }
            else {

                while(!feof($archivo)) {

                    $stringAux =  trim(fgets($archivo));
                    $auto = explode(" - " , $stringAux);
                    array_push($autos , new Auto($auto[0] , $auto[1] , $auto[2]));
                }

                fclose($archivo);
                return $autos;
            }
        }
    }
?>