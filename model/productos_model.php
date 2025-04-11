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

    // En productos_model.php, actualizar el método get_productos
    public function get_productos()
    {
        $sql = "SELECT *, 
            CASE WHEN rebajado = 1 AND precio_rebajado IS NOT NULL 
                 THEN precio_rebajado 
                 ELSE precio 
            END as precio_final 
            FROM productos ORDER BY fecha_subida DESC";
        $consulta = $this->db->query($sql);
        while ($registro = $consulta->fetch_assoc()) {
            $this->datos[] = $registro;
        }
        return $this->datos;
    }
    public function get_productos_by_categoria($categoria_id)
    {
        $datos = [];
        $sql = "SELECT *, 
            CASE WHEN rebajado = 1 AND precio_rebajado IS NOT NULL 
                 THEN precio_rebajado 
                 ELSE precio 
            END as precio_final 
            FROM productos WHERE categoria = ? ORDER BY fecha_subida DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $categoria_id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($registro = $result->fetch_assoc()) {
            $datos[] = $registro;
        }

        return $datos;
    }

    public function get_categorias()
    {
        $categorias = [];
        $sql = "SELECT * FROM categoria ORDER BY nombre_categoria";
        $consulta = $this->db->query($sql);

        while ($registro = $consulta->fetch_assoc()) {
            $categorias[] = $registro;
        }

        return $categorias;
    }

    public function get_categorias_por_general($catgeneral_id)
    {
        $categorias = [];
        $sql = "SELECT * FROM categoria WHERE catgeneral_id = ? ORDER BY nombre_categoria";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $catgeneral_id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($registro = $result->fetch_assoc()) {
            $categorias[] = $registro;
        }

        return $categorias;
    }

    public function get_categorias_generales()
    {
        $categorias = [];
        $sql = "SELECT * FROM categorias_generales ORDER BY nombre_catgeneral";
        $consulta = $this->db->query($sql);

        while ($registro = $consulta->fetch_assoc()) {
            $categorias[] = $registro;
        }

        return $categorias;
    }

    public function get_categoria_general_by_id($catgeneral_id)
    {
        $sql = "SELECT * FROM categorias_generales WHERE codigo_catgeneral = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $catgeneral_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return null;
    }

    public function get_categoria_by_id($categoria_id)
    {
        $sql = "SELECT c.*, cg.nombre_catgeneral 
                FROM categoria c
                LEFT JOIN categorias_generales cg ON c.catgeneral_id = cg.codigo_catgeneral
                WHERE c.codigo_categoria = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $categoria_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return null;
    }

    public function buscar_productos($searchTerm)
    {
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

    public function get_producto_by_id($codigo)
    {
        $sql = "SELECT p.*, c.nombre_categoria, cg.nombre_catgeneral,
                CASE WHEN p.rebajado = 1 AND p.precio_rebajado IS NOT NULL 
                     THEN p.precio_rebajado 
                     ELSE p.precio 
                END as precio_final 
                FROM productos p 
                LEFT JOIN categoria c ON p.categoria = c.codigo_categoria 
                LEFT JOIN categorias_generales cg ON c.catgeneral_id = cg.codigo_catgeneral
                WHERE p.codigo = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $codigo);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return null;
    }

    public function add_comentario($codigo_producto, $codigo_usuario, $comentario, $rating)
    {
        $codigo_comentario = uniqid('COM');
        $sql = "INSERT INTO comentario (codigo_comentario, comentario, rating, codigo_usuario, codigo_producto) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssiss", $codigo_comentario, $comentario, $rating, $codigo_usuario, $codigo_producto);
        return $stmt->execute();
    }

    public function get_comentarios_by_producto($codigo_producto)
    {
        $comentarios = [];
        $sql = "SELECT c.*, u.nombre_usuario 
                FROM comentario c
                JOIN usuarios u ON c.codigo_usuario = u.codigo_usuario
                WHERE c.codigo_producto = ?
                ORDER BY c.fecha_comentario DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $codigo_producto);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($registro = $result->fetch_assoc()) {
            $comentarios[] = $registro;
        }

        return $comentarios;
    }

    public function get_avg_rating_by_producto($codigo_producto)
    {
        $sql = "SELECT AVG(rating) as avg_rating FROM comentario WHERE codigo_producto = ? AND rating > 0";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $codigo_producto);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return $row['avg_rating'] ? round($row['avg_rating'], 1) : 0;
        }

        return 0;
    }
}
