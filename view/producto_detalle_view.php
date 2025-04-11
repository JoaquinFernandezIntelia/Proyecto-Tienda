<?php
require_once('view/menu_view.php');
require_once('view/navbar_view.php');
?>

<style>
    .product-detail-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .product-gallery {
        display: flex;
        justify-content: center;
        margin-bottom: 30px;
    }

    .product-image {
        width: 400px;
        height: 400px;
        object-fit: contain;
        border-radius: 8px;
    }

    .product-info {
        padding: 20px;
    }

    .product-title {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .product-price {
        font-size: 28px;
        color: #e63946;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .product-description {
        margin-bottom: 30px;
        line-height: 1.6;
    }

    .action-buttons {
        display: flex;
        gap: 15px;
        margin-bottom: 30px;
    }

    .cart-form {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
    }

    .quantity-input {
        width: 60px;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .rating-section {
        margin-top: 40px;
        border-top: 1px solid #eee;
        padding-top: 20px;
    }

    .rating-stars {
        display: flex;
        gap: 5px;
        margin-bottom: 10px;
    }

    .star {
        color: #ffc107;
        font-size: 24px;
        cursor: pointer;
    }

    .star:hover {
        color: #ffdb58;
    }

    .back-button {
        margin-top: 30px;
        text-decoration: none;
        color: #666;
    }

    .back-button:hover {
        text-decoration: underline;
    }
</style>

<div class="w3-main page-content">
    <div class="w3-hide-large content-push-small"></div>
    <div class="product-detail-container">

        <div class="w3-row">
            <div class="w3-col m6 l5">
                <div class="product-gallery">
                    <img src="uploads/<?php echo htmlspecialchars($producto['imagen']); ?>.avif" alt="<?php echo htmlspecialchars($producto['nombre_producto']); ?>" class="product-image">
                </div>
            </div>

            <div class="w3-col m6 l7">
                <div class="product-info">
                    <h1 class="product-title"><?php echo htmlspecialchars($producto['nombre_producto']); ?></h1>
                    <div class="product-price">
                        <?php if ($producto['rebajado'] == 1 && isset($producto['precio_rebajado'])): ?>
                            <span style="text-decoration: line-through; color: #888;"><?php echo htmlspecialchars(number_format($producto['precio'], 2)); ?>€</span>
                            <b class="discount-price"><?php echo htmlspecialchars(number_format($producto['precio_rebajado'], 2)); ?>€</b>
                        <?php else: ?>
                            <b><?php echo htmlspecialchars(number_format($producto['precio'], 2)); ?>€</b>
                        <?php endif; ?>
                    </div>

                    <div class="product-description">
                        <h3>Descripción:</h3>
                        <p><?php echo nl2br(htmlspecialchars($producto['descripcion'])); ?></p>
                    </div>

                    <form method="post" action="index.php?controlador=usuarios&action=almacenar_pedidos" class="cart-form">
                        <input type="hidden" name="codigo_producto" value="<?php echo htmlspecialchars($producto['codigo']); ?>">
                        <label for="cantidad">Cantidad:</label>
                        <input type="number" id="cantidad" name="cantidad" value="1" min="1" class="quantity-input">
                        <button type="submit" class="w3-button w3-green">Añadir al carrito</button>
                    </form>
                    <div class="product-category">
                        Categoría: <a href="index.php?controlador=productos&action=ver_categoria&categoria=<?php echo htmlspecialchars($producto['categoria']); ?>"><?php echo htmlspecialchars($producto['nombre_categoria']); ?></a>
                    </div>
                    <div class="rating-section">
                        <h3>Valorar este producto:</h3>
                        <div class="rating-stars">
                            <span class="star" data-rating="1">★</span>
                            <span class="star" data-rating="2">★</span>
                            <span class="star" data-rating="3">★</span>
                            <span class="star" data-rating="4">★</span>
                            <span class="star" data-rating="5">★</span>
                        </div>
                        <form id="rating-form" method="post" action="index.php?controlador=productos&action=valorar_producto">
                            <input type="hidden" name="codigo_producto" value="<?php echo htmlspecialchars($producto['codigo']); ?>">
                            <input type="hidden" name="rating" id="rating-value" value="0">
                            <textarea name="comentario" placeholder="Deja tu comentario (opcional)" class="w3-input w3-border" style="margin-bottom: 10px;"></textarea>
                            <button type="submit" class="w3-button w3-blue">Enviar valoración</button>
                        </form>
                    </div>

                    <a href="javascript:history.back()" class="back-button">← Volver a la página anterior</a>
                </div>
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