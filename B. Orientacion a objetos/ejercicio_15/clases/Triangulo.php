<?php
    class Triangulo extends FiguraGeometrica{
        
                private $_base;
                private $_altura;

                public function __construct($base , $altura){
                    parent::__construct();
                    $this->_base = $base;
                    $this->_altura = $altura;
                    $this->CalcularDatos();
                }
        
                protected function CalcularDatos(){
        
                    $this->_perimetro = $this->_base*3;
                    $this->_superficie = ($this->_base * $this->_altura)/2;
                }
        
                public function Dibujar(){
        
                    $string = "";
        
                    for($i=0 ; $i<$this->_altura ; $i++){

                        $flag = 1;
        
                        for($j=0 ; $j<$i+1 ; $j++){
                            
                            if($flag){

                                for($z=$i+1 ; $z<$this->_altura ; $z++){
                                    
                                     $string = $string."&mdash;";
                                }
                            }

                            if($flag){

                                $flag = 0;
                                $string = $string."*";
                            }
                            else{

                                $string = $string."**";
                            }
                        }
        
                        $string = $string."<br/>";
                    }
        
                    return $string;
                }
        
                public function ToString(){
        
                    return "Color: ".$this->_color."<br/>Base: ".$this->_base."<br/>Altura: ".$this->_altura."<br/>Perimetro: ".$this->_perimetro."<br/>Superficie: ".$this->_superficie."<br/><br/>".$this->Dibujar();
                }
            }
?>