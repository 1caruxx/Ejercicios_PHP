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

        public static function GuardarEnBD($objeto) {

            $datos = "mysql:host=localhost;dbname=parcial";
            $user = "root";
            $pass = "";

            try {

                $conexcion = new PDO($datos , $user , $pass);
                $resultados = $conexcion->prepare("INSERT INTO `helados` (`_sabor`,`_precio`,`_imagen`) VALUES ('".$objeto->GetSabor()."','".$objeto->GetPrecio()."','".$objeto->GetImagen()."')");
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

        public static function ObtenerHeladosBD() {
   
            $datos = "mysql:host=localhost;dbname=parcial";
            $user = "root";
            $pass = "";
            $helados = array();

            try {

                $conexcion = new PDO($datos , $user , $pass);
                $resultados = $conexcion->prepare("SELECT * FROM `helados`");
                $resultados->execute();

                while($fila = $resultados->fetch(PDO::FETCH_ASSOC)) {

                    array_push($helados , new Helado($fila["_sabor"] , $fila["_precio"] , $fila["_imagen"]));
                }

                $conexcion = null;
                return $helados;

                echo "Se ha cargado exitosamente.";
            }
            catch(PDOexception $excepcion) {

                echo "Atrapada una excepcion de tipo PDOexception: ".$excepcion->getMessage();
            }
            catch(exception $excepcion) {

                echo "Atrapada otro tipo de excepcion: ".$excepcion->getMessage();
            }
        }
    }
?>