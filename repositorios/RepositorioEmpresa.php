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
                $credenciales['usuario'],
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

   public function login($nombre, $clave)
   {
       $q = "SELECT cuitEmpresa, nombreEmpresa, domicilioEmpresa, saldoEmpresa, calveEmpresa FROM empresas WHERE empresa = ?";
       $query = self::$conexion->prepare($q);
       $query->bind_param("s", $nombre);

       if ($query->execute()) {
           $query->bind_result($cuit, $clave_encriptada, $nombre, $saldo, $direccion);
           if( $query->fetch() ) {
               if ( password_verify($clave, $clave_encriptada) ) {
                   return new empresa($nombre, $nombre, $apellido, $id);
               }
           }
       }
       return false;
    }

    public function save(Empresa $empresa, $clave)
    {

        function castID($id){
            $id = str_replace( array('-'), '', $id);
            return $int_value = intval($id);
        }

       $q = "INSERT INTO Empresas (cuitEmpresa, nombreEmpresa, domicilioEmpresa, saldoEmpresa, claveEmpresa) ";
       $q.= "VALUES (?, ?, ?, ?, ?)";
       $query = self::$conexion->prepare($q);
       $cuit = castID($empresa->getId());
       $nombre = $empresa->getNombre();
       $domicilio = $empresa->getDomicilio();
       $saldo = $empresa->getSaldo();
       $clave_encriptada = password_hash($clave, PASSWORD_DEFAULT);
       $query->bind_param(
           "sssss",
           $cuit,
           $nombre,
           $domicilio,
           $saldo,
           $clave_encriptada
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
