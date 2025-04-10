<?php
class Productos_model
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

    public function get_productos()
    {
        $sql = "SELECT * FROM productos ORDER BY fecha_subida DESC";
        $consulta = $this->db->query($sql);
        while ($registro = $consulta->fetch_assoc()) {
            $this->datos[] = $registro;
        }
        return $this->datos;
    }

    public function buscar_productos($searchTerm) {
        $datos = [];
        
        // Search only by nombre_producto
        $sql = "SELECT * FROM productos WHERE nombre_producto LIKE ?";
        
        $stmt = $this->db->prepare($sql);
        
        // Check if prepare was successful
        if ($stmt === false) {
            error_log("Prepare failed: " . $this->db->error);
            return $datos; // Return empty array if prepare failed
        }
        
        $likeTerm = "%" . $searchTerm . "%";
        
        // Only one parameter now since we're only searching by name
        $stmt->bind_param("s", $likeTerm);
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($registro = $result->fetch_assoc()) {
            $datos[] = $registro;
        }
        
        $stmt->close();
        return $datos;
    }
    public function get_producto_by_id($codigo) {
        $sql = "SELECT * FROM productos WHERE codigo = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $codigo);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        
        return null;
    }
}
