<?php

require_once '.env.php';
require_once 'entidades/Transaccion.php';

class RepositorioTransaccion{

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

public function save($transaccion)
{
   $q = "INSERT INTO transacciones (fechaTransaccion, montoTransaccion, clientes_idCliente, empresas_idEmpresa) ";
   $q.= "VALUES (?, ?, ?, ?)";
   $query = self::$conexion->prepare($q);
   $dni = $transaccion->getCliente_id();
   $cuit = $transaccion->getEmpresa_id();
   $monto = $transaccion->getMonto();
   $fechaTransaccion = new Datetime("now");
   $fechaTransaccion = $fechaTransaccion-> format("Y-m-d h:i:s");
   $query->bind_param(
       "ssss",
       $fechaTransaccion,
       $monto,
       $dni,
       $cuit
   );
   if ($query->execute()) {
       return self::$conexion->insert_id;
   } else {
       return false;
   }
}
}
