<?php

abstract class Usuario
{
    protected $id;
    protected $nombre_usuario;
    protected $saldo_usuario;

    public function __construct($id, $nombre_usuario, $saldo_usuario)
    {
        $this->id = $id;
        $this->nombre_usuario = $nombre_usuario;
        $this->saldo_usuario = $saldo_usuario;
    }

    public function getId() {return $this->id;}
    public function setid($id) {$this->id = $id;}
    public function getSaldoUsuario() {return $this->saldo_usuario;}
    public function getNombreApellido() {return "$this->nombre $this->apellido";}
}