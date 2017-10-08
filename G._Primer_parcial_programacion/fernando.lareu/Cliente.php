<?php

    class Cliente {

        private $_nombre;
        private $_correo;
        private $_clave;

        public function GetNombre() {

            return $this->_nombre;
        }

        public function GetCorreo() {

            return $this->_correo;
        }

        public function GetClave() {

            return $this->_clave;
        }

        public function __construct($nombre , $correo , $clave) {

            $this->_nombre = $nombre;
            $this->_correo = $correo;
            $this->_clave = $clave;
        }

        public function ToString()
        {

            return $this->_nombre." - ".$this->_correo." - ".$this->_clave."\r\n";
        }
        
        public static function GuardarEnArchivo($cliente) {

            $retorno = false;

            if(!@$archivo = fopen("./clientes/clientesActuales.txt" , "w")) {

                echo "Error al guardar";
            }
            else {

                $cantidad = fwrite($archivo , $cliente->ToString());

                if($cantidad > 0) {

                    $retorno = true;
                }

                fclose($archivo);
            }

            return $retorno;
        }
    }
?>