<?php

require_once 'repositorios/RepositorioEmpresa.php';
require_once 'entidades/Empresa.php';

class ControladorEmpresa
{
    protected $usuario = null;

    public function login($nombre, $clave)
    {
        $repo = new RepositorioEmpresa();
        $usuario = $repo->login($nombre, $clave);

        if ($usuario === false) {
            return [ false, "Error de credenciales" ];
        } else {
            session_start();
            $_SESSION['usuario'] = serialize($usuario);
            return [ true, "Usuario correctamente autenticado"];
        }
    }

    public function create($cuit, $nombre, $saldo, $domicilio, $clave)
    {
        $repo = new RepositorioEmpresa();
        $usuario = new Empresa($cuit, $nombre, $saldo, $domicilio);
        $cuit = $repo->save($usuario, $clave);
        if ($cuit === false) {
            return [false, "Error al crear el usuario"];
        } else {
            $usuario->setId($cuit);
            session_start();
            $_SESSION['usuario'] = serialize($usuario);
            return [true, "Usuario creado correctamente"];
        }
    }

    public function modificar($monto, Empresa $empresa)
    {
        $repo = new RepositorioEmpresa();
        $empresa->setDatos($empresa->getSaldo() + $monto);

        if ($repo->actualizar($empresa)) {
            session_start();
            $_SESSION['usuario'] = serialize($usuario);
            return [true, "Datos actualizados correctamente"];
        } else {
            return [false, "Error al actualizar datos"];
        }
    }
}
