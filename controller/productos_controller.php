    <?php
    session_start();
    function home()
    {
        require_once("model/productos_model.php");
        $datos = new Productos_model();
        $array = $datos->get_productos();
        $categorias_generales = $datos->get_categorias_generales();
        require_once("view/home_view.php");
    }

    function ver_categoria()
    {
        // Obtener el id de categoría si se proporciona, si no usar 0 para todos
        $categoria_id = isset($_GET['categoria']) ? $_GET['categoria'] : 0;

        require_once("model/productos_model.php");
        $datos = new Productos_model();

        // Obtener el nombre de la categoría
        $nombre_categoria = "Todos los productos";
        $nombre_catgeneral = "";
        if ($categoria_id > 0) {
            $categoria = $datos->get_categoria_by_id($categoria_id);
            if ($categoria) {
                $nombre_categoria = $categoria['nombre_categoria'];
                if (!empty($categoria['nombre_catgeneral'])) {
                    $nombre_catgeneral = $categoria['nombre_catgeneral'];
                }
            }
        }

        // Obtener productos filtrados por categoría
        $array = $categoria_id > 0 ?
            $datos->get_productos_by_categoria($categoria_id) :
            $datos->get_productos();

        // Cargar categorías generales para el menú
        $categorias_generales = $datos->get_categorias_generales();

        require_once("view/categoria_view.php");
    }

    function componentes()
    {
        // Redireccionar a la nueva función ver_categoria para la categoría "Componentes"
        require_once("model/productos_model.php");
        $datos = new Productos_model();
        $categorias = $datos->get_categorias();

        // Buscar el ID de la categoría "Componentes"
        $componentesId = 0;
        foreach ($categorias as $cat) {
            if ($cat['nombre_categoria'] == 'Componentes') {
                $componentesId = $cat['codigo_categoria'];
                break;
            }
        }

        if ($componentesId > 0) {
            header("Location: index.php?controlador=productos&action=ver_categoria&categoria=" . $componentesId);
        } else {
            header("Location: index.php?controlador=productos&action=ver_categoria");
        }
        exit;
    }

    function buscar()
    {
        if (isset($_GET['search'])) {
            $searchTerm = $_GET['search'];
            require_once('model/productos_model.php');
            $datos = new Productos_model();
            $resultados = $datos->buscar_productos($searchTerm);
            $categorias_generales = $datos->get_categorias_generales();

            require_once("view/search_results_view.php");
        } else {
            // If no search term provided, redirect to home
            header("Location: index.php");
            exit;
        }
    }

    function ver_detalle()
    {
        if (isset($_GET['codigo'])) {
            $codigo = $_GET['codigo'];
            require_once("model/productos_model.php");
            $datos = new Productos_model();
            $producto = $datos->get_producto_by_id($codigo);
            $categorias_generales = $datos->get_categorias_generales();

            if ($producto) {
                require_once("view/producto_detalle_view.php");
            } else {
                // Producto no encontrado, redireccionar a la página de inicio
                header("Location: index.php");
                exit;
            }
        } else {
            // No se especificó un código de producto, redireccionar a la página de inicio
            header("Location: index.php");
            exit;
        }
    }

    function valorar_producto()
    {
        if (isset($_POST['codigo_producto']) && isset($_POST['rating'])) {
            $codigo = $_POST['codigo_producto'];
            $rating = $_POST['rating'];
            $comentario = isset($_POST['comentario']) ? $_POST['comentario'] : '';

            // Verificar si el usuario está logueado
            if (!isset($_SESSION['username'])) {
                header("Location: index.php?controlador=usuarios&action=login");
                exit;
            }

            // Aquí implementarías la lógica para guardar la valoración en la base de datos
            // Por ahora, solo redirigiremos de vuelta a la página de detalle
            header("Location: index.php?controlador=productos&action=ver_detalle&codigo=" . urlencode($codigo) . "&rated=true");
            exit;
        } else {
            header("Location: index.php");
            exit;
        }
    }

    
