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
    <div class="w3-hide-large content-push-small"></div>
    <div class="content-section">
        <header class="w3-container w3-xlarge top-header">
            <h1 class="w3-left">Bienvenido a nuestra Tienda</h1>
        </header>

        <!-- Sección de productos rebajados -->
        <section class="rebajados-section">
            <h2>Productos Rebajados</h2>

            <?php if (empty($productos_rebajados)): ?>
                <div class="no-products">No hay productos rebajados disponibles.</div>
            <?php else: ?>
                <div class="w3-row product-grid">
                    <?php foreach ($productos_rebajados as $producto): ?>
                        <div class="w3-col product-card">
                            <a href="index.php?controlador=productos&action=ver_detalle&codigo=<?php echo htmlspecialchars($producto["codigo"]); ?>" class="product-link">
                                <div class="image-container">
                                    <img src="uploads/<?php echo htmlspecialchars($producto['imagen'] . '.avif'); ?>" alt="<?php echo htmlspecialchars($producto['nombre_producto']); ?>" />
                                </div>
                                <div class="product-info">
                                    <div class="product-name"><?php echo htmlspecialchars($producto['nombre_producto']); ?></div>
                                    <div class="product-price">
                                        <?php if ($producto['rebajado'] == 1 && isset($producto['precio_rebajado'])): ?>
                                            <div class="original-price"><?php echo htmlspecialchars(number_format($producto['precio'], 2)); ?>€</div>
                                            <div class="discount-price"><?php echo htmlspecialchars(number_format($producto['precio_rebajado'], 2)); ?>€</div>
                                        <?php else: ?>
                                            <div class="regular-price"><?php echo htmlspecialchars(number_format($producto['precio'], 2)); ?>€</div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </a>
                           
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>

        <!-- Sección de categorías -->
        <section class="categorias-section">
            <h2>Categorías</h2>
            <div class="category-grid">
                <div class="category-card">
                    <a href="index.php?controlador=productos&action=ver_categoria&categoria=electronica" class="category-link">
                        <img src="images/electronica.jpg" alt="Electrónica" />
                        <h3>Electrónica</h3>
                    </a>
                </div>
                <div class="category-card">
                    <a href="index.php?controlador=productos&action=ver_categoria&categoria=hogar" class="category-link">
                        <img src="images/hogar.jpg" alt="Hogar" />
                        <h3>Hogar</h3>
                    </a>
                </div>
                <div class="category-card">
                    <a href="index.php?controlador=productos&action=ver_categoria&categoria=moda" class="category-link">
                        <img src="images/moda.jpg" alt="Moda" />
                        <h3>Moda</h3>
                    </a>
                </div>
                <div class="category-card">
                    <a href="index.php?controlador=productos&action=ver_categoria&categoria=juguetes" class="category-link">
                        <img src="images/juguetes.jpg" alt="Juguetes" />
                        <h3>Juguetes</h3>
                    </a>
                </div>
            </div>
        </section>
    </div>
</div>