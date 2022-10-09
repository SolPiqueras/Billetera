<?php
require_once '.env.php';
require_once 'entidades/Empresa.php';

class RepositorioEmpresa
{
    private static $conexion = null;

    public function __construct()
    {
        if (is_null(self::$conexion)) {
            $credenciales = credenciales();
            self::$conexion = new mysqli(
                $credenciales['servidor'],
                $credenciales['empresa'],
                $credenciales['clave'],
                $credenciales['base_de_datos'],
            );
            if (self::$conexion->connect_error) {
                $error = 'Error de conexión: ' . self::$conexion->connect_error;
                self::$conexion = null;
                die($error);
            }
            self::$conexion->set_charset('utf8');
        }
   }

   public function login($nombre_empresa, $clave)
   {
       $q = "SELECT cuit, nombreEmpresa, domicilioEmpresa, claveEmpresa, saldoEmpresa FROM empresas WHERE empresas = ?";
       $query = self::$conexion->prepare($q);
       $query->bind_param("s", $nombre_empresa);

       if ($query->execute()) {
           $query->bind_result($cuit, $nombre_empresa, domicilio_empresa, $clave_encriptada, $saldo_empresa);
           if( $query->fetch() ) {
               if ( password_verify($clave, $clave_encriptada) ) {
                   return new empresa($cuit, $nombre_empresa, domicilio_empresa, $saldo_empresa);
               }
           }
       }
       return false;
    }

    public function save(Empresa $empresa, $clave)
    {
       $q = "INSERT INTO empresas (cuit, nombreEmpresa, domicilioEmpresa, claveEmpresa, saldoEmpresa) ";
       $q.= "VALUES (?, ?, ?, ?, ?)";
       $query = self::$conexion->prepare($q);
       $cuit = $empresa->getCuit();
       $nombre_empresa = $empresa->getEmpresa();
       $domicilio_empresa = $empresa->getDomicilio();       
       $clave_encriptada = password_hash($clave, PASSWORD_DEFAULT);
       $saldo_empresa = $empresa->getSaldoempresa();
       $query->bind_param(
           "sssss",
           $cuit,
           $nombre_empresa,
           $domicilio_empresa,
           $clave_encriptada,
           $saldo_empresa
       );
       if ($query->execute()) {
           // Se guardó bien, retornamos el id del empresa
           return self::$conexion->insert_cuit;
       } else {
           // No se guardó bien, retornamos false
           return false;
       }
    }
}