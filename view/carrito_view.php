<?php
require_once('view/navbar_view.php');
require_once('view/menu_view.php');
?>
<div class="page-content">
    <div class="cart-container">
        <h2>Tu Carrito de Compras</h2>

        <?php if (!isset($_SESSION['carrito']) || count($_SESSION['carrito']) == 0): ?>
            <div class="empty-cart">
                <p>Tu carrito está vacío</p>
                <a href="index.php" class="btn">Ir a la tienda</a>
            </div>
        <?php else: ?>
            <?php
            $total = 0;
            foreach ($_SESSION['carrito'] as $item):
                // Check if rebajado keys exist
                $rebajado = isset($item['rebajado']) ? $item['rebajado'] : 0;
                $precio_rebajado = isset($item['precio_rebajado']) ? $item['precio_rebajado'] : null;

                $precio_actual = ($rebajado == 1 && $precio_rebajado !== null) ?
                    $precio_rebajado : $item['precio'];
                $subtotal = $precio_actual * $item['cantidad'];
                $total += $subtotal;
            ?>
                <div class="cart-item">
                    <div class="cart-item-img">
                        <img src="uploads/<?php echo htmlspecialchars($item['imagen']); ?>.avif" alt="<?php echo htmlspecialchars($item['nombre']); ?>" />
                    </div>
                    <div class="cart-item-details">
                        <h3><?php echo htmlspecialchars($item['nombre']); ?></h3>
                        <p>Precio:
                            <?php if ($rebajado == 1 && $precio_rebajado !== null): ?>
                                <span style="text-decoration: line-through; color: #888;"><?php echo htmlspecialchars(number_format($item['precio'], 2)); ?>€</span>
                                <span class="discount-price"><?php echo htmlspecialchars(number_format($precio_rebajado, 2)); ?>€</span>
                            <?php else: ?>
                                <?php echo htmlspecialchars(number_format($item['precio'], 2)); ?>€
                            <?php endif; ?>
                        </p>
                        <p>Cantidad:
                        <form action="index.php?controlador=usuarios&action=actualizar_carrito" method="post" style="display: inline;">
                            <input type="hidden" name="producto_id" value="<?php echo htmlspecialchars($item['codigo']); ?>">
                            <input type="number" name="cantidad" value="<?php echo htmlspecialchars($item['cantidad']); ?>" min="1" class="quantity-input">
                            <button type="submit" name="update_cart" class="btn">Actualizar</button>
                        </form>
                        </p>
                        <p>Subtotal: <?php echo number_format($subtotal, 2); ?>€</p>
                    </div>
                    <div class="cart-item-actions">
                        <a href="index.php?controlador=usuarios&action=eliminar_producto_carrito&producto_id=<?php echo $item['codigo']; ?>" class="btn"    >Eliminar</a>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="cart-summary">
                <h3>Total: <?php echo number_format($total, 2); ?>€</h3>
                <a href="index.php?controlador=productos&action=componentes" class="btn">Seguir comprando</a>
                <a href="index.php?controlador=usuarios&action=finalizar_compra" class="btn">Finalizar compra</a>
            </div>
        <?php endif; ?>
    </div>
</div>