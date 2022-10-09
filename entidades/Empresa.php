<?php

require_once 'modelo/Usuario.php';

class Empresa extends Usuario{

    protected $domicilio_empresa;

    public function __construct($cuit, $nombre_empresa, $saldo_empresa, $domicilio_empresa){
        parent::__construct($cuit, $nombre_empresa, $saldo_empresa);
        $this->domicilio_empresa = $domicilio_empresa;
    }
    
    public function getDomicilio() {return $this->domicilio_empresa;}
}