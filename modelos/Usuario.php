<?php

abstract class Usuario 
{
    protected $id;
    protected $nombre;
    protected $saldo;

    public function __construct($id, $nombre, $saldo)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->saldo = $saldo;
    }

    public function getId() {return $this->id;}
    public function setId($id) {$this->id = $id;}
    public function getSaldo() {return $this->saldo;}
    public function setSaldo(){$this->saldo;}
    public function getNombre() {return $this->nombre;}
    public function setDatos($saldo){$this->saldo= $saldo;}

}
