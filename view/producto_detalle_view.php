<?php
require_once('view/menu_view.php');
require_once('view/navbar_view.php');
?>

<div class="w3-main page-content">
    <div class="w3-hide-large content-push-small"></div>
    <div class="product-detail-container">
        <!-- Breadcrumb navigation -->
        <div class="breadcrumb">
            <a href="index.php">Inicio</a> <span>›</span> 
            <a href="index.php?controlador=productos&action=ver_categoria&categoria=<?php echo htmlspecialchars($producto['categoria']); ?>">
                <?php echo htmlspecialchars($producto['nombre_categoria']); ?>
            </a> <span>›</span>
            <span><?php echo htmlspecialchars($producto['nombre_producto']); ?></span>
        </div>

        <div class="product-content">
            <!-- Left column - Product gallery -->
            <div class="product-gallery">
                <img src="uploads/<?php echo htmlspecialchars($producto['imagen']); ?>.avif" 
                     alt="<?php echo htmlspecialchars($producto['nombre_producto']); ?>" 
                     class="product-image">
            </div>
            <div class="product-buy-box">
                <div class="product-availability">
                    <span class="availability-dot"></span> En stock - Envío inmediato
                </div>
                
                <div class="product-price-container">
                    <?php if ($producto['rebajado'] == 1 && isset($producto['precio_rebajado'])): ?>
                        <div class="original-price"><?php echo htmlspecialchars(number_format($producto['precio'], 2)); ?>€</div>
                        <div class="product-price">
                            <span class="discount-price"><?php echo htmlspecialchars(number_format($producto['precio_rebajado'], 2)); ?>€</span>
                        </div>
                    <?php else: ?>
                        <div class="product-price">
                            <?php echo htmlspecialchars(number_format($producto['precio'], 2)); ?>€
                        </div>
                    <?php endif; ?>
                    <div class="tax-info">IVA incluido</div>
                    <div class="tax-info">Vendedor: <?php   ?></div>
                </div>
                
                <form method="post" action="index.php?controlador=usuarios&action=almacenar_pedidos" class="cart-form">
                    <input type="hidden" name="codigo_producto" value="<?php echo htmlspecialchars($producto['codigo']); ?>">
                    
                    <div class="quantity-container">
                        <label for="cantidad" class="quantity-label">Cantidad:</label>
                        <input type="number" id="cantidad" name="cantidad" value="1" min="1" class="quantity-input">
                    </div>
                    
                    <button type="submit" class="add-to-cart-btn">
                        <i class="fa fa-shopping-cart"></i> Añadir al carrito
                    </button>
                </form>
                
                <div class="shipping-info">
                    <p><i class="fa fa-truck"></i> Envío gratis para pedidos superiores a 50€</p>
                    <p><i class="fa fa-shield"></i> Garantía de 2 años en todos los productos</p>
                </div>
            </div>
            <!-- Middle column - Product details -->
            <div class="product-details">
                <h1 class="product-title"><?php echo htmlspecialchars($producto['nombre_producto']); ?></h1>
                <div class="product-reference">Código: <?php echo htmlspecialchars($producto['codigo']); ?></div>
                
                <div class="product-description">
                    <h3>Descripción:</h3>
                    <p><?php echo nl2br(htmlspecialchars($producto['descripcion'])); ?></p>
                </div>
                
                <div class="product-category">
                    <strong>Categoría:</strong> 
                    <a href="index.php?controlador=productos&action=ver_categoria&categoria=<?php echo htmlspecialchars($producto['categoria']); ?>">
                        <?php echo htmlspecialchars($producto['nombre_categoria']); ?>
                    </a>
                </div>
            </div>

            <!-- Right column - Buy box -->
            

            <!-- Rating section - Full width -->
            <div class="rating-section">
                <h3 class="rating-title">Valorar este producto:</h3>
                <div class="rating-stars">
                    <span class="star" data-rating="1">★</span>
                    <span class="star" data-rating="2">★</span>
                    <span class="star" data-rating="3">★</span>
                    <span class="star" data-rating="4">★</span>
                    <span class="star" data-rating="5">★</span>
                </div>
                
                <form id="rating-form" class="rating-form" method="post" action="index.php?controlador=productos&action=valorar_producto">
                    <input type="hidden" name="codigo_producto" value="<?php echo htmlspecialchars($producto['codigo']); ?>">
                    <input type="hidden" name="rating" id="rating-value" value="0">
                    <textarea name="comentario" placeholder="Deja tu comentario (opcional)" class="w3-input w3-border"></textarea>
                    <button type="submit" class="submit-rating-btn">Enviar valoración</button>
                </form>
                
                <a href="javascript:history.back()" class="back-button">← Volver a la página anterior</a>
            </div>
        </div>
    </div>
</div>

<script>
    // Rating functionality
    const stars = document.querySelectorAll('.star');
    const ratingInput = document.getElementById('rating-value');

    stars.forEach(star => {
        star.addEventListener('click', () => {
            const rating = star.getAttribute('data-rating');
            ratingInput.value = rating;

            // Reset all stars
            stars.forEach(s => s.style.color = '#ffc107');

            // Fill stars up to selected rating
            for (let i = 0; i < rating; i++) {
                stars[i].style.color = '#ffdb58';
            }
        });
    });
</script>