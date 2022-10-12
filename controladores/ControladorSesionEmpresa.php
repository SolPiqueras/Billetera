<?php

require_once 'repositorios/RepositorioEmpresa.php';
require_once 'entidades/Empresa.php';

class ControladorSesionEmpresa
{
    protected $usuario = null;

    public function login($nombre, $clave)
    {
        $repo = new RepositorioEmpresa();
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
}
