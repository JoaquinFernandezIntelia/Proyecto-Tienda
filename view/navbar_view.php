<?php
// Calculate cart items count
$cartCount = 0;
if (isset($_SESSION['carrito'])) {
    $cartCount = count($_SESSION['carrito']);
}

if (!isset($_SESSION["username"])) {
    echo '<div class="navbar-top">
        <div class="navbar-bar navbar-black navbar-card">
            <a class="navbar-item navbar-button navbar-padding-large navbar-hide-medium navbar-hide-large navbar-right" href="javascript:void(0)" onclick="toggleNavbarMenu()" title="Toggle Navigation Menu">
                <i class="fa fa-bars"></i>
            </a>
            <a href="index.php" class="navbar-item navbar-button navbar-padding-large">INICIO</a>
      <div class="navbar-search-container">
    <form action="index.php" method="GET" style="display: flex; width: 100%; margin: 0;">
        <input type="hidden" name="controlador" value="productos">
        <input type="hidden" name="action" value="buscar">
        <input type="text" name="search" id="Busqueda" class="navbar-search-input" placeholder="Buscar" required>
        <button type="submit" class="navbar-search-button">
            <i class="fa fa-search"></i>
        </button>
    </form>
</div>
            <div class="navbar-dropdown-hover navbar-hide-small">
                <button class="navbar-padding-large navbar-button" title="More">MAS <i class="fa fa-caret-down"></i></button>
                <div class="navbar-dropdown-content navbar-bar-block navbar-card-4">
                    <a href="#" class="navbar-item navbar-button"></a>
                    <a href="#" class="navbar-item navbar-button">GESTION CUENTA</a>
                    <a href="#" class="navbar-item navbar-button">TUS PEDIDOS</a>
                    <a href="#" class="navbar-item navbar-button">FACTURAS</a>
                </div>
            </div>
            <a href="index.php?controlador=usuarios&action=login" class="navbar-item navbar-button navbar-padding-large navbar-hide-small">INICIA SESION</a>
        </div>
    </div>';
} else {
    echo '<div class="navbar-top">
        <div class="navbar-bar navbar-black navbar-card">
            <a class="navbar-item navbar-button navbar-padding-large navbar-hide-medium navbar-hide-large navbar-right" href="javascript:void(0)" onclick="toggleNavbarMenu()" title="Toggle Navigation Menu">
                <i class="fa fa-bars"></i>
            </a>
            <a href="index.php" class="navbar-item navbar-button navbar-padding-large">INICIO</a>
             <div class="navbar-search-container">
    <form action="index.php" method="GET" style="display: flex; width: 100%; margin: 0;">
        <input type="hidden" name="controlador" value="productos">
        <input type="hidden" name="action" value="buscar">
        <input type="text" name="search" id="Busqueda" class="navbar-search-input" placeholder="Buscar" required>
        <button type="submit" class="navbar-search-button">
            <i class="fa fa-search"></i>
        </button>
    </form>
</div>
            
            <!-- Carrito desplegable simplificado -->
            <div class="navbar-dropdown-hover navbar-hide-small">
                <a href="index.php?controlador=usuarios&action=ver_carrito" class="navbar-padding-large navbar-button" title="Ver carrito">
                    <i class="fa fa-shopping-cart w3-margin-right"></i>
                    <span class="cart-count">' . $cartCount . '</span>
                </a>
                <div class="navbar-dropdown-content navbar-bar-block navbar-card-4">
                    <div class="cart-dropdown-header">
                        <strong>Tu carrito</strong>
                    </div>';

    // Mostrar los primeros 4 productos en el carrito si hay más de 4
    $cartItemsToShow = ($_SESSION['carrito'] > 4) ? array_slice($_SESSION['carrito'], 0, 4) : $_SESSION['carrito'];

    // Mostrar los elementos del carrito
    if ($cartCount > 0) {
        foreach ($cartItemsToShow as $item) {
            echo '<div class="cart-item">
                                <div class="cart-item-img">
                                    <img src="uploads/' . htmlspecialchars($item['imagen']) . '.avif" alt="' . htmlspecialchars($item['nombre']) . '" width="50" />
                                </div>
                                <div class="cart-item-details">
                                    <p>' . htmlspecialchars($item['nombre']) . '</p>
                                    <p><b>' . htmlspecialchars($item['precio']) . '€</b> x ' . htmlspecialchars($item['cantidad']) . '</p>
                                </div>
                            </div>';
        }

        // Si hay más de 4 productos, añadir un mensaje
        if ($cartCount > 4) {
            echo '<p class="more-items-message">Y ' . ($cartCount - 4) . ' productos más...</p>';
        }

        echo '<a href="index.php?controlador=usuarios&action=ver_carrito" class="navbar-item navbar-button">VER CARRITO</a>';
    } else {
        echo '<p class="empty-cart-message">Tu carrito está vacío</p>';
    }

    echo '
                </div>
            </div>
            
            <!-- Menú de usuario -->
            <div class="navbar-dropdown-hover navbar-hide-small">
                <button class="navbar-padding-large navbar-button" title="More">' . $_SESSION["username"] . '<i class="fa fa-caret-down"></i></button>
                <div class="navbar-dropdown-content navbar-bar-block navbar-card-4">
                    <a href="index.php?controlador=usuarios&action=gestion_cuenta" class="navbar-item navbar-button">GESTION CUENTA</a>
                    <a href="index.php?controlador=usuarios&action=tus_pedidos" class="navbar-item navbar-button">TUS PEDIDOS</a>
                    <a href="index.php?controlador=usuarios&action=facturas" class="navbar-item navbar-button">FACTURAS</a>
                    <a href="index.php?controlador=usuarios&action=desconectar" class="navbar-item navbar-button">CERRAR SESIÓN</a>
                </div>
            </div>
        </div>
    </div>';
}
