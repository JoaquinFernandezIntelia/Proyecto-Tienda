<?php
require_once('view/menu_view.php');
require_once('view/navbar_view.php');
?>

<style>
    .product-detail-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Breadcrumb styles */
    .breadcrumb {
        display: flex;
        margin-bottom: 20px;
        font-size: 14px;
        color: #666;
    }
    
    .breadcrumb a {
        color: #3498db;
        text-decoration: none;
        margin: 0 5px;
    }
    
    .breadcrumb a:hover {
        text-decoration: underline;
    }
    
    .breadcrumb span {
        margin: 0 5px;
    }

    /* Product layout */
    .product-content {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    /* Left column - Gallery */
    .product-gallery {
        flex: 0 0 30%;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .product-image {
        width: 100%;
        height: auto;
        max-height: 400px;
        object-fit: contain;
    }

    /* Middle column - Info */
    .product-details {
        flex: 0 0 40%;
    }

    .product-title {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 15px;
        color: #2c3e50;
    }

    .product-reference {
        color: #777;
        font-size: 14px;
        margin-bottom: 20px;
    }

    .product-description {
        margin-bottom: 30px;
        line-height: 1.6;
        color: #333;
    }
    
    .product-description h3 {
        font-size: 18px;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .product-category {
        margin-top: 20px;
        font-size: 14px;
        color: #555;
    }
    
    .product-category a {
        color: #3498db;
        text-decoration: none;
    }
    
    .product-category a:hover {
        text-decoration: underline;
    }

    /* Right column - Buy box */
    .product-buy-box {
        flex: 0 0 25%;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .product-availability {
        color: #2ecc71;
        font-weight: 600;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
    }
    
    .availability-dot {
        width: 10px;
        height: 10px;
        background-color: #2ecc71;
        border-radius: 50%;
        display: inline-block;
        margin-right: 8px;
    }

    .product-price-container {
        margin-bottom: 25px;
    }

    .product-price {
        font-size: 28px;
        font-weight: 700;
        color: #2c3e50;
    }

    .original-price {
        text-decoration: line-through;
        color: #888;
        font-size: 16px;
        display: block;
        margin-bottom: 5px;
    }

    .discount-price {
        color: #e74c3c;
    }
    
    .tax-info {
        font-size: 12px;
        color: #999;
        margin-top: 5px;
    }

    .cart-form {
        margin-top: 20px;
    }

    .quantity-container {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .quantity-label {
        margin-right: 10px;
        font-weight: 500;
    }

    .quantity-input {
        width: 60px;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        text-align: center;
    }

    .add-to-cart-btn {
        width: 100%;
        padding: 12px;
        background-color: #3498db;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .add-to-cart-btn:hover {
        background-color: #2980b9;
    }
    
    .shipping-info {
        margin-top: 20px;
        font-size: 13px;
        color: #666;
    }

    /* Rating section */
    .rating-section {
        margin-top: 40px;
        border-top: 1px solid #eee;
        padding-top: 20px;
        flex-basis: 100%;
    }

    .rating-title {
        font-size: 18px;
        margin-bottom: 15px;
    }

    .rating-stars {
        display: flex;
        gap: 5px;
        margin-bottom: 15px;
    }

    .star {
        color: #ffc107;
        font-size: 24px;
        cursor: pointer;
    }

    .star:hover {
        color: #ffdb58;
    }
    
    .rating-form textarea {
        margin-bottom: 15px;
        height: 100px;
    }
    
    .submit-rating-btn {
        padding: 10px 15px;
        background-color: #3498db;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    
    .submit-rating-btn:hover {
        background-color: #2980b9;
    }

    .back-button {
        display: inline-block;
        margin-top: 30px;
        padding: 10px 15px;
        text-decoration: none;
        color: #666;
    }

    .back-button:hover {
        text-decoration: underline;
    }
    
    /* Responsive adjustments */
    @media (max-width: 1200px) {
        .product-gallery {
            flex: 0 0 40%;
        }
        .product-details {
            flex: 0 0 55%;
        }
        .product-buy-box {
            flex: 0 0 100%;
            margin-top: 20px;
        }
    }
    
    @media (max-width: 768px) {
        .product-gallery {
            flex: 0 0 100%;
        }
        .product-details {
            flex: 0 0 100%;
        }
    }
</style>

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

<?php include_once 'footer_view.php'; ?>