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
       $q = "SELECT id, clave, nombre, apellido FROM usuarios WHERE usuario = ?";
       $query = self::$conexion->prepare($q);
       $query->bind_param("s", $nombre);

       if ($query->execute()) {
           $query->bind_result($id, $clave_encriptada, $nombre, $apellido);
           if( $query->fetch() ) {
               if ( password_verify($clave, $clave_encriptada) ) {
                   return new Usuario($nombre, $nombre, $apellido, $id);
               }
           }
       }
       return false;
    }

    public function save(Usuario $usuario, $clave)
    {
       $q = "INSERT INTO clientes (dniCliente, nombreCliente, claveCliente, saldoCliente) ";
       $q.= "VALUES (?, ?, ?, ?)";
       $query = self::$conexion->prepare($q);
       $dni = $usuario->getDni();
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
           // Se guardó bien, retornamos el id del usuario
           return self::$conexion->insert_id;
       } else {
           // No se guardó bien, retornamos false
           return false;
       }
    }
}
