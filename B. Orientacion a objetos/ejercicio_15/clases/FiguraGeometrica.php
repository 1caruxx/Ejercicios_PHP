<?php

    class FiguraGeometrica{
        protected $_color;
        protected $_perimetro;
        protected $_superficie;

        public __contruct(){
            $this->color = "Sin asignar";
            $this->perimetro = "Sin agisnar";
            $this->superficie = "Sin asignar";
        }

        public abstract function Dibujar();
        protected abstract function MostrarDatos();

        public function SetColor($color){
            $this->_color = $color;
        }

        public function GetColor(){
            return $this->_color;
        }

    }
?>