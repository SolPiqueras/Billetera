<?php

class Cliente
{
    protected $dni;
    protected $nombre;
    protected $saldo;

    public function __construct($dni, $nombre, $saldo)
    {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->saldo = $saldo;
    }

    public function getDni() {return $this->dni;}
    public function setDni($dni) {$this->dni = $dni;}
    public function getSaldo() {return $this->saldo;}
    public function getNombre() {return $this->nombre;}
}
