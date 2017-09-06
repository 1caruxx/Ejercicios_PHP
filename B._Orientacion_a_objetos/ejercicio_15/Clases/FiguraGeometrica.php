<?php
    abstract class  FiguraGeometrica{

        protected $_color;
        protected $_perimetro;
        protected $_superficie;

        public function __construct(){

            $this->_color = "Black";
        }

        public function GetColor(){

            return $this->_color;
        }

        public function SetColor($color){

            $this->_color = $color;
        }

        public function ToString(){

        }

        public abstract function Dibujar();
        protected abstract function CalcularDatos();
    }
?>