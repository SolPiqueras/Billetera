<?php

require_once '.env.php';
require_once 'entidades/Cliente.php';

public function save(Cliente $usuario, $clave)
{
   $q = "INSERT INTO clientes (dniCliente, nombreCliente, claveCliente, saldoCliente) ";
   $q.= "VALUES (?, ?, ?, ?)";
   $query = self::$conexion->prepare($q);
   $dni = $usuario->getId();
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
