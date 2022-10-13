<?php

require_once '.env.php';
require_once 'entidades/Cliente.php';
require_once 'entidades/Empresa.php';

class RepositorioTransaccion{
    
public function save(Cliente $usuario, Empresa $empresa, $monto)
{
   $q = "INSERT INTO transacciones (fechaTransaccion, montoTransaccion, clientes_idCliente, empresas_idEmpresa) ";
   $q.= "VALUES (?, ?, ?, ?)";
   $query = self::$conexion->prepare($q);
   $dni = $usuario->getId();
   $cuit = $empresa->getCuit();
   $fechaTransaccion = new Datetime("now");
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
