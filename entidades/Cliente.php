<?php
require_once 'modelos/Usuario.php';

class Cliente extends Usuario
{
    public function __construct($dni, $nombre, $saldo)
    {
        parent::__construct($dni, $nombre, $saldo);
    }
}
