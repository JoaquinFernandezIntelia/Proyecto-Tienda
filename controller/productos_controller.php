<?php
session_start();
function home()
{
    require_once("model/productos_model.php");
    $datos = new Productos_model();
    $array = $datos->get_productos();
    require_once("view/home_view.php");
}

function componentes() {
    require_once("model/productos_model.php");
    $datos = new Productos_model();
    $array = $datos->get_productos();
    require_once("view/componentes_view.php");

    if (isset($_POST['search'])) {
        $searchTerm = $_POST['search'];
        require_once('model/productos_model.php');
        $datos = new Productos_model();
        $resultados = $datos->buscar_productos($searchTerm); // Llama a la función de búsqueda
    
        // Generar el HTML para los resultados
        if (empty($resultados)) {
            echo '<p>No se encontraron productos que coincidan con su búsqueda.</p>';
        } else {
            foreach ($resultados as $producto) {
                echo '<div class="product-item">
                        <div class="w3-container">
                            <img src="uploads/' . htmlspecialchars($producto['imagen'] . '.avif') . '" alt="' . htmlspecialchars($producto['nombre_producto']) . '" />
                            <p>' . htmlspecialchars($producto['nombre_producto']) . '<br><b>' . htmlspecialchars($producto['precio']) . '€</b></p>
                        </div>
                      </div>';
            }
        }
    }
}

function buscar()
{
    if (isset($_GET['search'])) {
        $searchTerm = $_GET['search'];
        require_once('model/productos_model.php');
        $datos = new Productos_model();
        $resultados = $datos->buscar_productos($searchTerm);
        
        require_once("view/search_results_view.php");
    } else {
        // If no search term provided, redirect to home
        header("Location: index.php");
        exit;
    }
}

function ver_detalle() {
    if (isset($_GET['codigo'])) {
        $codigo = $_GET['codigo'];
        require_once("model/productos_model.php");
        $datos = new Productos_model();
        $producto = $datos->get_producto_by_id($codigo);
        
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

function valorar_producto() {
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