<?php

class Transaccion{

    protected $id;
    protected $fecha_transaccion;
    protected $saldo;
    protected $cliente_id;
    protected $empresa_id;

    public function __construct($fecha_transaccion, $saldo,  $cliente_id, $empresa_id, $id = null)
    {
        $this->id = $id;
        $this->saldo = $saldo;
        $this->fecha_transaccion = $fecha_transaccion;
        $this->cliente_id = $cliente_id;
        $this->empresa_id =$empresa_id;
    }

    public function getId() {return $this->id;}
    public function setId($id) {$this->id = $id;}
    public function getFechaTransaccion() {return $this->fecha_transaccion;}
    public function getSaldo() {return $this->saldo;}
    public function getCliente_id() {return $this->cliente_id;}
    public function getEmpresa_id() {return $this->empresa_id;}

}