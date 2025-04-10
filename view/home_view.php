<?php
require_once('view/menu_view.php');
require_once('view/navbar_view.php');
require_once('model/productos_model.php');

$datos = new Productos_model();
$productos = $datos->get_productos(); // Obtener todos los productos
$productos_rebajados = array_filter($productos, function ($producto) {
    return $producto['rebajado'] == true; // Filtrar productos rebajados
});
?>

<div class="w3-main page-content">
    <div class="content-section">
        <header class="w3-container w3-xlarge top-header">
            <h1>Bienvenido a nuestra Tienda</h1>
        </header>

        <!-- Sección de productos rebajados -->
        <section class="rebajados-section">
            <h2>Productos Rebajados</h2>
            <div class="product-grid">
                <?php foreach ($productos_rebajados as $producto): ?>
                    <div class="product-item">
                        <div class="w3-container">
                            <img src="uploads/<?php echo htmlspecialchars($producto['imagen'] . '.avif'); ?>" alt="<?php echo htmlspecialchars($producto['nombre_producto']); ?>" />
                            <p><?php echo htmlspecialchars($producto['nombre_producto']); ?><br><b><?php echo htmlspecialchars($producto['precio']); ?>€</b></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
        <!-- Sección de categorías -->
        <section class="categorias-section">
            <h2>Categorías</h2>
            <div class="category-grid">
                <div class="category-card">
                    <a href="productos.php?categoria=electronica">
                        <img src="images/electronica.jpg" alt="Electrónica" />
                        <h3>Electrónica</h3>
                    </a>
                </div>
                <div class="category-card">
                    <a href="productos.php?categoria=hogar">
                        <img src="images/hogar.jpg" alt="Hogar" />
                        <h3>Hogar</h3>
                    </a>
                </div>
                <div class="category-card">
                    <a href="productos.php?categoria=moda">
                        <img src="images/moda.jpg" alt="Moda" />
                        <h3>Moda</h3>
                    </a>
                </div>
                <div class="category-card">
                    <a href="productos.php?categoria=juguetes">
                        <img src="images/juguetes.jpg" alt="Juguetes" />
                        <h3>Juguetes</h3>
                    </a>
                </div>
            </div>
        </section>
    </div>
</div>