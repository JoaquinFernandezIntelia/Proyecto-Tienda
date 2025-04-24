<?php
class Usuarios_model
{
    private $db; //conexion con la BBDD
    private $datos; //array de datos de la bbdd
    public function __construct()
    {
        require_once("model/conectar.php");
        $this->db = Conectar::conexion();
        $this->datos = [];
    }
    //TODO: DECLARAR METODOS DE ACCESO A LOS DATOS...
    public function get_datos()
    {
        $sql = "SELECT * FROM usuarios";
        $consulta = $this->db->query($sql);
        while ($registro = $consulta->fetch_assoc()) {
            $this->datos[] = $registro;
        }
        return $this->datos;
    }
    public function login($user, $contra)
    {
        $sql = "SELECT * FROM usuarios WHERE nombre_usuario='$user' and password='$contra'";
        $consulta = $this->db->query($sql);
        return (mysqli_num_rows($consulta) > 0);
    }
    public function borrar($user)
    {
        $sql = "DELETE FROM usuarios WHERE nombre='$user'";
        return ($this->db->query($sql));
    }
    public function insertar($user, $pswd)
    {
        $sql = "INSERT INTO usuarios (nombre,passwd) VALUES ('$user','$pswd')";
        return ($this->db->query($sql));
    }

    // Guarda el carrito en la base de datos
    public function guardar_carrito($usuario_id, $carrito)
    {
        // Primero eliminar el carrito existente del usuario
        $sql = "DELETE FROM carrito WHERE codigo_usuario = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();

        // Luego insertar los nuevos elementos
        if (!empty($carrito)) {
            $fecha = date('Y-m-d H:i:s');
            $sql = "INSERT INTO carrito (codigo_usuario, codigo_producto, cantidad, fecha_agregado) VALUES (?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);

            foreach ($carrito as $item) {
                $stmt->bind_param("issi", $usuario_id, $item['codigo'], $item['cantidad'], $fecha);
                $stmt->execute();
            }
        }

        return true;
    }

    // Carga el carrito desde la base de datos
    public function cargar_carrito($usuario_id)
    {
        $carrito = [];

        $sql = "SELECT c.*, p.nombre_producto, p.precio, p.imagen FROM carrito c 
            JOIN productos p ON c.codigo_producto = p.codigo 
            WHERE c.codigo_usuario = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $carrito[] = [
                'codigo' => $row['codigo_producto'],
                'nombre' => $row['nombre_producto'],
                'precio' => $row['precio'],
                'imagen' => $row['imagen'],
                'cantidad' => $row['cantidad']
            ];
        }

        return $carrito;
    }

    // Obtener el ID de usuario basado en el nombre de usuario
    public function get_usuario_id($nombre_usuario)
    {
        $sql = "SELECT codigo_usuario FROM usuarios WHERE nombre_usuario = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $nombre_usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return $row['codigo_usuario'];
        }

        return null;
    }
    // Obtener información del vendedor por código
}
