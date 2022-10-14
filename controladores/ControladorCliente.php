<?php

require_once 'repositorios/RepositorioCliente.php';
require_once 'entidades/Cliente.php';

class ControladorCliente
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

    public function create($dni, $nombre, $saldo, $clave)
    {
        $repo = new RepositorioCliente();
        $usuario = new Cliente($dni, $nombre, $saldo);
        $dni = $repo->save($usuario, $clave);
        if ($dni === false) {
            return [false, "Error al crear el usuario"];
        } else {
            $usuario->setId($dni);
            session_start();
            $_SESSION['usuario'] = serialize($usuario);
            return [true, "Usuario creado correctamente"];
        }
    }

    public function recargar($saldo, Cliente $usuario)
    {
        $repo = new RepositorioCliente();
        $usuario->setDatos($usuario->getSaldo() + $saldo);

        if ($repo->actualizar($usuario)) {
            session_start();
            $_SESSION['usuario'] = serialize($usuario);
            return [true, "Datos actualizados correctamente"];
        } else {
            return [false, "Error al actualizar datos"];
        }
    }

    public function pagar($monto, Cliente $usuario)
    {
        $repo = new RepositorioCliente();
        $usuario->setDatos($usuario->getSaldo() - $monto);

        if ($repo->actualizar($usuario)) {
            session_start();
            $_SESSION['usuario'] = serialize($usuario);
            return [true, "Datos actualizados correctamente"];
        } else {
            return [false, "Error al actualizar datos"];
        }
    }

    public function eliminar(Cliente $cliente)
    {
        $repo = new RepositorioCliente();

        if($repo->eliminar($cliente)) {
            return [true, "Usuario eliminado correctamente"];
        } else {
            return [false, "Error al eliminar el usuario"];
        }
    }
}
