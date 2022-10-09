<?php

class Transacciones{

    protected $id_transaccion;
    protected $fecha_transaccion;
    protected $monto_transaccion;

    public function __construct($cuit, $nombre_empresa, $saldo_empresa, $domicilio_empresa){
        parent::__construct($cuit, $nombre_empresa, $saldo_empresa);
        $this->domicilio_empresa = $domicilio_empresa;
    }
    
    public function getDomiciolio() {return $this->domicilio_empresa;}
}