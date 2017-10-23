<?php

    require_once "./IVendible.php";

    class Patineta implements Ivendible {

        private $_marca;
        private $_precio;
        private $_pathFoto;

        public function GetMarca() {

            return $this->_marca;
        }

        public function GetPrecio() {

            return $this->_precio;
        }
        public function GetFoto() {

            return $this->_pathFoto;
        }

        public function __construct($marca , $precio , $foto) {

            $this->_marca = $marca;
            $this->_precio = $precio;
            $this->_pathFoto = $foto;

        }

        public function PreciosMasIVA() {

            return $this->_precio*1.21;
        }

        public static function RetornarArrayDePatinetas() {

            $patinetas = array();

            array_push($patinetas , new Patineta("A" , 200 , "A.jpg"));
            array_push($patinetas , new Patineta("B" , 120.5 , "B.jpg"));
            array_push($patinetas , new Patineta("C" , 1000 , "C.jpg"));
            array_push($patinetas , new Patineta("D" , 250 , "D.jpg"));
            array_push($patinetas , new Patineta("E" , 500 , "E.jpg"));
            array_push($patinetas , new Patineta("F" , 750 , "F.jpg"));
            array_push($patinetas , new Patineta("G" , 340 , "G.jpg"));

            return $patinetas;
        }

        public function ToString() {

            return "{$this->_marca} - {$this->_precio} - {$this->_pathFoto}\r\n";
        }

        public static function GuardarEnBD($objeto) {

            $datos = "mysql:host=localhost;dbname=recu";
            $user = "root";
            $pass = "";

            try {

                $conexcion = new PDO($datos , $user , $pass);
                $resultados = $conexcion->prepare("INSERT INTO `patinetas` (`marca`,`precio`,`path_foto`) VALUES ('".$objeto->GetMarca()."','".$objeto->GetPrecio()."','".$objeto->GetFoto()."')");
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

        public static function ObtenerPatinetasBD($condicion=1) {
   
            $datos = "mysql:host=localhost;dbname=recu";
            $user = "root";
            $pass = "";
            $patinetas = array();

            try {

                $conexcion = new PDO($datos , $user , $pass);
                $resultados = $conexcion->prepare("SELECT * FROM `patinetas` WHERE {$condicion}");
                $resultados->execute();

                while($fila = $resultados->fetch(PDO::FETCH_ASSOC)) {

                    array_push($patinetas , new Patineta($fila["marca"] , $fila["precio"] , $fila["path_foto"]));
                }

                $conexcion = null;
                return $patinetas;
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