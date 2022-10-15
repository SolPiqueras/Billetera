<?php
require_once '.env.php';
require_once 'entidades/Cliente.php';

class RepositorioCliente
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
    function castID($id){
        $id = str_replace( array('-'), '', $id);
        return $int_value = intval($id);
    }
       $q = "SELECT dniCliente, nombreCliente, claveCliente, saldoCliente FROM clientes WHERE dniCliente = ?";
       $query = self::$conexion->prepare($q);
       $dni = castID($nombre);
       $query->bind_param("s", $nombre);

       if ($query->execute()) {
           $query->bind_result($dni, $nombre, $clave_encriptada, $saldoCliente);
           if( $query->fetch() ) {
               if ( password_verify($clave, $clave_encriptada) ) {
                   return new Cliente($dni, $nombre, $saldoCliente);
               }
           }
       }
       return false;
    }

    public function save(Cliente $usuario, $clave)
    {
        function castID($id){
            $id = str_replace( array('-'), '', $id);
            return $int_value = intval($id);
        }
       $q = "INSERT INTO clientes (dniCliente, nombreCliente, claveCliente, saldoCliente) ";
       $q.= "VALUES (?, ?, ?, ?)";
       $query = self::$conexion->prepare($q);
       $dni = castID($usuario->getId());
       $nombre = $usuario->getNombre();
       $saldo = $usuario->getSaldo();
       $clave_encriptada = password_hash($clave, PASSWORD_DEFAULT);
       $query->bind_param(
           "ssss",
           $dni,
           $nombre,
           $clave_encriptada,
           $saldo
       );
       if ($query->execute()) {
           return self::$conexion->insert_id;
       } else {
           return false;
       }
    }

    public function actualizar(Cliente $u)
    {
        $q = "UPDATE clientes SET saldoCliente = ? WHERE dniCliente = ?";
        $query = self::$conexion->prepare($q);
        $saldo = $u->getSaldo();
        $id = $u->getId();

        $query->bind_param("sd", $saldo, $id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function eliminar(Cliente $u)
    {
        $q = "DELETE FROM clientes WHERE dniCliente = ? ";
        $query = self::$conexion->prepare($q);

        $id = $u->getId();

        $query->bind_param("d", $id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
