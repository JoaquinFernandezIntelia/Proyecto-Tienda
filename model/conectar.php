<?php
class Conectar
{
    public static function conexion()
    {
        try {
            $conexion = new mysqli("127.0.0.1", "root", "", "tienda-prueba1");
            if ($conexion->connect_error) {
                throw new Exception('Error de conexión: ' . $conexion->connect_error);
            }
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
        return $conexion;
    }
}
