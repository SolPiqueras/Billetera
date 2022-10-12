<?php
require_once 'modelos/Usuario.php';

class Empresa extends Usuario{

    protected $domicilio;
    
        public function __construct($cuit, $nombre, $saldo, $domicilio)
        {
            parent::__construct($cuit, $nombre, $saldo);
            $this->domicilio = $domicilio;
        }
    
        public function getDomicilio() {return $this->domicilio;}
}