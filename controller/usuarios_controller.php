<?php
session_start();
function home()
{
    require_once("model/usuarios_model.php");
    $datos = new Usuarios_model();
    $message = "";
    $array = $datos->get_datos();
    require_once("view/usuarios_view.php");
}


function login() {
    require_once("model/usuarios_model.php");
    $datos = new Usuarios_model();
    $message = "";
    
    if (!isset($_SESSION["id"])) {
        if (isset($_POST["submit"])) {
            $usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : '';
            $paswd = isset($_POST["password"]) ? $_POST["password"] : '';
            
            if ($datos->login($usuario, $paswd)) {
                $_SESSION["username"] = $usuario;
                
                // Obtener el ID del usuario
                $usuario_id = $datos->get_usuario_id($usuario);
                $_SESSION["usuario_id"] = $usuario_id;
                
                // Cargar el carrito del usuario desde la base de datos
                $_SESSION['carrito'] = $datos->cargar_carrito($usuario_id);
                
                header("Location: index.php");
                exit;
            } else {
                $message = "Usuario o contraseña incorrectos";
            }
        }
    }
    
    require_once("view/login_view.php");
}

function almacenar_pedidos() {
    // Verificar si el usuario está logueado
    if (!isset($_SESSION["username"])) {
        header("Location: index.php?controlador=usuarios&action=login");
        exit;
    }
    
    // Inicializar el carrito en la sesión si no existe
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }
    
    // Verificar si se está añadiendo un producto al carrito
    if (isset($_POST['codigo_producto'])) {
        $codigo_producto = $_POST['codigo_producto'];
        $cantidad = isset($_POST['cantidad']) ? intval($_POST['cantidad']) : 1;
        
        // Asegurarse de que la cantidad sea al menos 1
        if ($cantidad < 1) {
            $cantidad = 1;
        }
        
        // Cargar la información del producto
        require_once("model/productos_model.php");
        $productos_model = new Productos_model();
        $producto = $productos_model->get_producto_by_id($codigo_producto);
        
        if ($producto) {
            // Verificar si el producto ya existe en el carrito
            $found = false;
            foreach ($_SESSION['carrito'] as &$item) {
                if ($item['codigo'] === $codigo_producto) {
                    $item['cantidad'] += $cantidad;
                    $found = true;
                    break;
                }
            }
            
            // Si no se encontró, añadirlo como un nuevo elemento
            if (!$found) {
                $_SESSION['carrito'][] = [
                    'codigo' => $codigo_producto,
                    'nombre' => $producto['nombre_producto'],
                    'precio' => $producto['precio'],
                    'precio_rebajado' => isset($producto['precio_rebajado']) ? $producto['precio_rebajado'] : null,
                    'rebajado' => isset($producto['rebajado']) ? $producto['rebajado'] : 0,
                    'imagen' => $producto['imagen'],
                    'cantidad' => $cantidad
                ];
            }
            
            // Guardar el carrito en la base de datos
            require_once("model/usuarios_model.php");
            $usuarios_model = new Usuarios_model();
            $usuarios_model->guardar_carrito($_SESSION["usuario_id"], $_SESSION['carrito']);
            
            // Obtener la URL de referencia para redirigir de vuelta
            $referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';
            
            // Redirigir de vuelta a la página anterior con un mensaje de éxito
            header("Location: $referrer?msg=added");
            exit;
        }
    }
    
    // Si llegamos aquí, redirigir al carrito
    header("Location: index.php?controlador=usuarios&action=ver_carrito");
    exit;
} 
function ver_carrito() {
    // Initialize the cart if it doesn't exist
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }
    
    // Update existing cart items to ensure they have the 'rebajado' key
    foreach ($_SESSION['carrito'] as &$item) {
        if (!isset($item['rebajado'])) {
            $item['rebajado'] = 0;
        }
        if (!isset($item['precio_rebajado'])) {
            $item['precio_rebajado'] = null;
        }
    }
    
    require_once("view/carrito_view.php");
}
// Añadir a la función almacenar_pedidos, después del bloque que añade productos
// Si estamos eliminando un producto
function eliminar_producto_carrito() {
    // Verificar si el usuario está logueado
    if (!isset($_SESSION["username"])) {
        header("Location: index.php?controlador=usuarios&action=login");
        exit;
    }
    
    // Verificar si estamos eliminando un producto
    if (isset($_GET['producto_id'])) {
        $producto_id = $_GET['producto_id'];
        
        if (isset($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $key => $item) {
                if ($item['codigo'] === $producto_id) {
                    unset($_SESSION['carrito'][$key]);
                    break;
                }
            }
            
            // Re-indexar el array
            $_SESSION['carrito'] = array_values($_SESSION['carrito']);
            
            // Guardar el carrito en la base de datos
            require_once("model/usuarios_model.php");
            $usuarios_model = new Usuarios_model();
            $usuarios_model->guardar_carrito($_SESSION["usuario_id"], $_SESSION['carrito']);
        }
    }
    
    // Redirigir de vuelta a la vista del carrito
    header("Location: index.php?controlador=usuarios&action=ver_carrito");
    exit;
}

function actualizar_carrito() {
    // Verificar si el usuario está logueado
    if (!isset($_SESSION["username"])) {
        header("Location: index.php?controlador=usuarios&action=login");
        exit;
    }
    
    // Verificar si estamos actualizando un elemento del carrito
    if (isset($_POST['update_cart']) && isset($_POST['producto_id'])) {
        $producto_id = $_POST['producto_id'];
        $cantidad = isset($_POST['cantidad']) ? intval($_POST['cantidad']) : 1;
        
        // Asegurarse de que la cantidad sea al menos 1
        if ($cantidad < 1) {
            $cantidad = 1;
        }
        
        // Actualizar el elemento del carrito
        if (isset($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as &$item) {
                if ($item['codigo'] === $producto_id) {
                    $item['cantidad'] = $cantidad;
                    break;
                }
            }
            
            // Guardar el carrito en la base de datos
            require_once("model/usuarios_model.php");
            $usuarios_model = new Usuarios_model();
            $usuarios_model->guardar_carrito($_SESSION["usuario_id"], $_SESSION['carrito']);
        }
        
        // Redirigir de vuelta a la vista del carrito
        header("Location: index.php?controlador=usuarios&action=ver_carrito");
        exit;
    }
}

function finalizar_compra() {
    // Check if cart is empty
    if (!isset($_SESSION['carrito']) || count($_SESSION['carrito']) == 0) {
        header("Location: index.php?controlador=usuarios&action=ver_carrito");
        exit;
    }
    
    // Calculate cart total
    $total = 0;
    foreach ($_SESSION['carrito'] as $item) {
        $subtotal = $item['precio'] * $item['cantidad'];
        $total += $subtotal;
    }
    
    // Load the checkout view
    require_once("view/checkout_view.php");
}

function desconectar() {
    // Guardar el carrito en la base de datos antes de cerrar sesión
    if (isset($_SESSION["usuario_id"]) && isset($_SESSION['carrito'])) {
        require_once("model/usuarios_model.php");
        $usuarios_model = new Usuarios_model();
        $usuarios_model->guardar_carrito($_SESSION["usuario_id"], $_SESSION['carrito']);
    }
    
    // Destruir la sesión
    session_destroy();
    header("Location: index.php");
    exit;
}

function procesar_pedido() {
    // Verificar si hay productos en el carrito
    if (!isset($_SESSION['carrito']) || count($_SESSION['carrito']) == 0) {
        header("Location: index.php");
        exit;
    }
    
    // Verificar si el usuario está logueado
    if (!isset($_SESSION['username'])) {
        header("Location: index.php?controlador=usuarios&action=login");
        exit;
    }
    
    // Verificar que todos los campos requeridos estén presentes
    $camposRequeridos = ['nombre', 'apellidos', 'email', 'telefono', 'direccion', 
                        'ciudad', 'provincia', 'codigo_postal', 'nombre_tarjeta', 
                        'numero_tarjeta', 'fecha_expiracion', 'cvv'];
    
    foreach ($camposRequeridos as $campo) {
        if (!isset($_POST[$campo]) || empty($_POST[$campo])) {
            // Redirigir de vuelta al formulario con un mensaje de error
            header("Location: index.php?controlador=usuarios&action=finalizar_compra&error=missing_fields");
            exit;
        }
    }
    
    // Aquí irían las validaciones adicionales de los datos
    // Y el procesamiento del pago
    
    // Crear el pedido en la base de datos
    // (Esto requeriría tener un modelo de pedidos)
    
    // Vaciar el carrito
    $_SESSION['carrito'] = [];
    
    // Redirigir a una página de confirmación
    header("Location: index.php?controlador=usuarios&action=confirmacion_pedido");
    exit;
}

function confirmacion_pedido() {
    require_once("view/confirmacion_pedido_view.php");
}