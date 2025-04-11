<?php 
include_once 'view/navbar_view.php';
include_once 'view/menu_view.php';
?>

<div class="w3-main page-content">
    <div class="w3-hide-large content-push-small"></div>
    <div class="content-section">
        <header class="w3-container w3-xlarge top-header">
            <p class="w3-left categoria-title">Resultados de búsqueda para: "<span class="search-term"><?php echo htmlspecialchars($_GET['search']); ?></span>"</p>
        </header>

        <?php if (empty($resultados)): ?>
            <div class="no-products">
                <i class="fa fa-search" style="font-size: 32px; margin-bottom: 15px; color: #adb5bd;"></i>
                <p>No se encontraron productos que coincidan con su búsqueda.</p>
                <p>Intente con otro término o revise la ortografía.</p>
            </div>
        <?php else: ?>
            <div class="w3-row product-grid">
                <?php foreach ($resultados as $producto): ?>
                    <div class="w3-col product-card">
                        <a href="index.php?controlador=productos&action=ver_detalle&codigo=<?php echo htmlspecialchars($producto["codigo"]); ?>" class="product-link">
                            <div class="image-container">
                                <img src="uploads/<?php echo htmlspecialchars($producto['imagen'] . '.avif'); ?>" alt="<?php echo htmlspecialchars($producto['nombre_producto']); ?>" />
                            </div>
                            <div class="product-info">
                                <div class="product-name"><?php echo htmlspecialchars($producto['nombre_producto']); ?></div>
                                <div class="product-price">
                                    <?php if (isset($producto['rebajado']) && $producto['rebajado'] == 1 && isset($producto['precio_rebajado'])): ?>
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
    </div>
</div>