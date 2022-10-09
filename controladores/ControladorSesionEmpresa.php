<?php

require_once 'repositorios/RepoEmpresa.php';
require_once 'entidades/Empresa.php';

class ControladorSesionEmpresa
{
    protected $empresa = null;

    public function login($nombre_empresa, $clave)
    {
        $repo = new RepoEmpresa();
        $empresa = $repo->login($nombre_empresa, $clave);

        if ($empresa === false) {
            //Falló el login
            return [ false, "Error de credenciales" ];
        } else {
            //Login correcto, ingresar al sistema
            session_start();
            $_SESSION['empresa'] = serialize($empresa);
            return [ true, "empresa correctamente autenticado"];
        }
    }

    public function create($cuit, $nombre_empresa, $domicilio_empresa, $clave_encriptada, $saldo_empresa)
    {
        $repo = new RepoEmpresa();
        $empresa = new Empresa($cuit, $nombre_empresa, $domicilio_empresa, $clave_encriptada, $saldo_empresa);
        $cuit = $repo->save($empresa, $clave);
        if ( $cuit === false) {
            return [false, "Error al crear el empresa"];
        } else {
            $empresa->setCuit($cuit);
            session_start();
            $_SESSION['empresa'] = serialize($empresa);
            return [true, "empresa creado correctamente"];
        }
    }
}