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
        exit; // Asegúrate de salir para no cargar el resto del controlador
    }
}

