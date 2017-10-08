<?php

    class Cd {

        //El nombre de los atributos debe coincidir con el nombre de los campos de mi base de datos
        private $titel;
        private $interpret;
        private $jahr;

        public function ToString() {

            return $this->titel." - ".$this->interpret." - ".$this->jahr;
        }
    }
?>