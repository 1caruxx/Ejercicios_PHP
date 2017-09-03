<?php
    include_once "../FiguraGeometrica.php";

    class Rectangulo extends FiguraGeometrica{
        private $base;
        private $altura;

        public __construct($base, $altura){
            parent::__construct();
            $this->base = $base;
            $this->altura = $altura;
            $this->CalcularDatos($base, $altura);
        }

        protected function CalcularDatos($base, $altura){
            $this->_perimetro = $base*2 + $altura*2;
            $this->_superficie = $base*$altura;
        }

        public function ToString(){
            return "Color: ", $this->color, "<br/>Perimetro: ", $this->perimetro, "<br/>Superficie: ", $this->superficie, "<br/>", $this->dibujar();
        }

        public function Dibujar(){
            $string;

            for($i=0;$i<$this->altura;$i++){
                for($j=0;$j<$this->base;$j++){
                    $string = $string."*";
                }
                $string = $string."<br/>";
            }

            return $string;
        }
    }
?>