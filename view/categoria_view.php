<?php
require_once('view/menu_view.php');
require_once('view/navbar_view.php');

echo '<div class="w3-main page-content">
<div class="w3-hide-large content-push-small"></div>
<div class="content-section">
 <header class="w3-container w3-xlarge top-header">
    <p class="w3-left categoria-title">' . htmlspecialchars($nombre_categoria) . '</p>';

if (!empty($nombre_catgeneral)) {
    echo '<p class="w3-left categoria-general">Categoría: ' . htmlspecialchars($nombre_catgeneral) . '</p>';
}

echo '</header>';

// Mostrar mensaje si no hay productos
if (empty($array)) {
    echo '<div class="no-products">No hay productos disponibles en esta categoría.</div>';
} else {
    echo '<div class="w3-row product-grid">';

    foreach ($array as $registro) {
        echo '<div class="w3-col product-card">
                <a href="index.php?controlador=productos&action=ver_detalle&codigo=' . htmlspecialchars($registro["codigo"]) . '" class="product-link">
                    <div class="image-container">
                        <img src="uploads/' . htmlspecialchars($registro["imagen"] . ".avif") . '" alt="' . htmlspecialchars($registro["nombre_producto"]) . '"/>
                    </div>
                    <div class="product-info">
                        <div class="product-name">' . htmlspecialchars($registro["nombre_producto"]) . '</div>
                        <div class="product-price">';

        // Display prices with discount formatting if applicable
        if ($registro['rebajado'] == 1 && isset($registro['precio_rebajado'])) {
            echo '<div class="original-price">' . htmlspecialchars(number_format($registro['precio'], 2)) . '€</div>
                  <div class="discount-price">' . htmlspecialchars(number_format($registro['precio_rebajado'], 2)) . '€</div>';
        } else {
            echo '<div class="regular-price">' . htmlspecialchars(number_format($registro['precio'], 2)) . '€</div>';
        }

        echo '</div>
              </div>
              </a>
             
            </div>';
    }

    echo '</div>'; // Cierra product-grid
}

echo '</div>'; // Cierra content-section
echo '</div>'; // Cierra w3-main
?>