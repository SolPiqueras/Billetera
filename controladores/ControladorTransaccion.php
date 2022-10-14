<?php

require_once 'repositorios/RepositorioTransaccion.php';
require_once 'entidades/Transaccion.php';
require_once 'entidades/Cliente.php';
require_once 'controladores/ControladorCliente.php';

class ControladorTransaccion
{
    protected $transaccion = null;

    public function create($monto, Cliente $cliente, $empresa_id)
    {
        $repo = new RepositorioTransaccion();
        $transaccion = new Transaccion($monto, $cliente->getId(), $empresa_id);
        $id = $repo->save($transaccion);
        if ($id === false) {
            return [false, "Error al crear la transaccion"];
        } else {
            $transaccion->setId($id);
            $repoCliente = new ControladorCliente();
            $repoCliente->pagar($monto, $cliente);
            return [true, "transaccion creada correctamente"];
        }
    }
}
