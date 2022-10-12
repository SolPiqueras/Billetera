<?php

require_once 'repositorios/RepositorioCliente.php';
require_once 'entidades/Cliente.php';

class ControladorSesionCliente
{
    protected $usuario = null;

    public function login($nombre, $clave)
    {
        $repo = new RepositorioCliente();
        $usuario = $repo->login($nombre, $clave);

        if ($usuario === false) {
            //Falló el login
            return [ false, "Error de credenciales" ];
        } else {
            //Login correcto, ingresar al sistema
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
}
