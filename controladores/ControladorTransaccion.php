<?php

require_once 'repositorios/RepositorioTransaccion.php';
require_once 'entidades/Transaccion.php';

class ControladorTransaccion
{
    protected $usuario = null;

    public function login($nombre, $clave)
    {
        $repo = new RepositorioCliente();
        $usuario = $repo->login($nombre, $clave);

        if ($usuario === false) {
            return [ false, "Error de credenciales" ];
        } else {
            session_start();
            $_SESSION['usuario'] = serialize($usuario);
            return [ true, "Usuario correctamente autenticado"];
        }
    }

    public function create($id, $fecha_transaccion, $saldo, $cliente_id, $empresa_id)
    {
        $repo = new RepositorioTransacciones();
        $usuario = new Transacciones($id, $fecha_transaccion, $saldo, $cliente_id, $empresa_id);
        $id = $repo->save($usuario, $clave);
        if ($id === false) {
            return [false, "Error al crear el usuario"];
        } else {
            $usuario->setId($id);
            session_start();
            $_SESSION['usuario'] = serialize($usuario);
            return [true, "Usuario creado correctamente"];
        }
    }
}
