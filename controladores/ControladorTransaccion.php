<?php

require_once 'repositorios/RepositorioTransaccion.php';
require_once 'entidades/Transaccion.php';

class ControladorTransaccion
{
    protected $transaccion = null;

    public function create($monto, $cliente_id, $empresa_id)
    {
        $repo = new RepositorioTransaccion();
        $transaccion = new Transaccion($monto, $cliente_id, $empresa_id);
        $id = $repo->save($transaccion);
        if ($id === false) {
            return [false, "Error al crear el transa$transaccion"];
        } else {
            $transaccion->setId($id);
            session_start();
            $_SESSION['transa$transaccion'] = serialize($transaccion);
            return [true, "transa$transaccion creado correctamente"];
        }
    }
}
