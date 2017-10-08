<?php

    class Cd {

        //El nombre de los atributos debe coincidir con el nombre de los campos de mi base de datos
        public $titel;
        public $interpret;
        public $jahr;
        public $id;

        public function ToString() {

            return $this->titel." - ".$this->interpret." - ".$this->jahr;
        }
    }
?>