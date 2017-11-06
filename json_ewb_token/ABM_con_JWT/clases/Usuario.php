<?php

    class Usuario {

        private $_correo;
        private $_clave;
        private $_nombre;
        private $_foto;

        public function GetCorreo() {

            return $this->_correo;
        }

        public function GetClave() {
            
            return $this->_clave;
        }

        public function GetNombre() {

            return $this->_nombre;
        }

        public function GetFoto() {
            
            return $this->_foto;
        }

        public function __construct($correo , $clave , $nombre , $foto) {

            $this->_correo = $correo;
            $this->_clave = $clave;
            $this->_nombre = $nombre;
            $this->_foto = $foto;
        }

        public function ToString() {

            return $this->_correo." - ".$this->_clave." - ".$this->_nombre." - ".$this->_foto."\r\n";
        }
    }

?>