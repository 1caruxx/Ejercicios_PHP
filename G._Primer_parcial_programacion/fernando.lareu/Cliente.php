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

        public function ToString() {
            
            return "{$this->_nombre} - {$this->_correo} - {$this->_clave}\r\n";
        }

        public static function GuardarEnArchivo($objeto) {

            if(!@ $archivo = fopen("./clientes/clientesActuales.txt" , "a")) {

                echo "No se ha podido abrir el archivo.";
            }
            else {

                fwrite($archivo , $objeto->tostring());
                fclose($archivo);

                echo "Se ha cargado exitosamente.";
            }
        }

        public static function ObtenerClientes() {

            $clientes = array();
            $stringAux = "";

            if(!@ $archivo = fopen("./clientes/clientesActuales.txt" , "r")) {

                echo "No se ha podido abrir el archivo.";
            }
            else {

                while(!feof($archivo)) {

                    $stringAux =  trim(fgets($archivo));
                    $cliente = explode(" - " , $stringAux);
                    array_push($clientes , new Cliente($cliente[0] , $cliente[1] , $cliente[2]));
                }

                fclose($archivo);
                return $clientes;
            }
        }
    }
?>