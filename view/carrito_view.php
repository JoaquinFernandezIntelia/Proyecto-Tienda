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
                $subtotal = $item['precio'] * $item['cantidad'];
                $total += $subtotal;
            ?>
                <div class="cart-item">
                    <div class="cart-item-img">
                        <img src="uploads/<?php echo htmlspecialchars($item['imagen']); ?>.avif" alt="<?php echo htmlspecialchars($item['nombre']); ?>" />
                    </div>
                    <div class="cart-item-details">
                        <h3><?php echo htmlspecialchars($item['nombre']); ?></h3>
                        <p>Precio: <?php echo htmlspecialchars($item['precio']); ?>€</p>
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
                        <a href="index.php?controlador=usuarios&action=almacenar_pedidos&remove=1&producto_id=<?php echo htmlspecialchars($item['codigo']); ?>" class="btn">Eliminar</a>
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
    <script>
    function toggleNavbarMenu() {
        var x = document.getElementById("navbarMenu");
        if (x.className.indexOf("navbar-show") == -1) {
            x.className += " navbar-show";
        } else { 
            x.className = x.className.replace(" navbar-show", "");
        }
    }
    </script>