<?php

    class Empleado {

        private $_nombre;
        private $_apellido;
        private $_edad;
        private $_direccion;
        private $_correoElectronico;
        private $_curriculum;

        public function __construct($nombre , $apellido , $edad , $direccion , $correoElectronico , $curriculum) {

            $this->_nombre = $nombre;
            $this->_apellido = $apellido;
            $this->_edad = $edad;
            $this->_direccion = $direccion;
            $this->_correoElectronico = $correoElectronico;
            $this->_curriculum = $curriculum;
        }

        public function ToString() {

            return "Nombre: ".$this->_nombre."<br/>Apellido: ".$this->_apellido."<br/>Edad: ".$this->_edad."<br/>Direccion: ".$this->_direccion."<br/>Correo electronico: ".$this->_correoElectronico."<br/>Curriculum: ".$this->_curriculum;
        }
    }
?>