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

        public function __construct($nombre=null , $correo=null , $clave=null) {

            if($nombre && $correo && $clave) {

                $this->_nombre = $nombre;
                $this->_correo = $correo;
                $this->_clave = $clave;
            }
        }

        public function ToString() {
            
            return "{$this->_nombre} - {$this->_correo} - {$this->_clave}\r\n";
        }

        public static function GuardarEnBD($objeto) {

            $datos = "mysql:host=localhost;dbname=parcial";
            $user = "root";
            $pass = "";

            try {

                $conexcion = new PDO($datos , $user , $pass);
                $resultados = $conexcion->prepare("INSERT INTO `clientes` (`_nombre`,`_correo`,`_clave`) VALUES ('".$objeto->getNombre()."','".$objeto->getCorreo()."','".$objeto->getClave()."')");
                $resultados->execute();

                $conexcion = null;

                echo "Se ha cargado exitosamente.";
            }
            catch(PDOexception $excepcion) {

                echo "Atrapada una excepcion de tipo PDOexception: ".$excepcion->getMessage();
            }
            catch(exception $excepcion) {

                echo "Atrapada otro tipo de excepcion : ".$excepcion->getMessage();
            }
        }

        public static function ObtenerClientesBD() {

            $datos = "mysql:host=localhost;dbname=parcial";
            $user = "root";
            $pass = "";
            $clientes = array();

            try {

                $conexcion = new PDO($datos , $user , $pass);
                $resultados = $conexcion->prepare("SELECT * FROM clientes");
                $resultados->execute();

                /*
                 * El metodo Fetchobject para crear una instancia de la clase que se le pasa como parametro, precisa que el constructor
                     * de esta clase no reciba parametros (constructor por defecto) o que no tenga constructor.
                 * Para simular un constructor por defecto se puede hacer que todos los parametros que reciba un constructor sean prestablecidos.
                 */
                while($columna = $resultados->fetchobject("Cliente")) {
                    
                    array_push($clientes , $columna);
                }

                $conexcion = null;
                return $clientes;
            }
            catch(PDOexception $excepcion) {

                echo "Atrapada una excepcion de tipo PDOexception: ".$excepcion->getMessage();
            }
            catch(exception $excepcion) {

                echo "Atrapada otro tipo de excepcion : ".$excepcion->getMessage();
            }
        }
    }
?>