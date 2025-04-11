<style>
  .product-card {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  margin-bottom: 20px;
  padding: 15px;
  border-radius: 8px;
}

.product-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 6px 12px rgba(0,0,0,0.1);
}

.product-link {
  text-decoration: none;
  color: inherit;
  display: block;
  cursor: pointer;
}

.product-link img {
  width: 100%;
  height: auto;
  object-fit: cover;
  margin-bottom: 10px;
  border-radius: 6px;
}

.categoria-title {
  font-size: 24px;
  margin-bottom: 5px;
  font-weight: bold;
}

.categoria-general {
  font-size: 14px;
  color: #666;
  margin-bottom: 20px;
}

.no-products {
  padding: 20px;
  text-align: center;
  background-color: #f1f1f1;
  border-radius: 5px;
  margin: 20px 0;
}
</style>
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
  echo '<div class="w3-row w3-grayscale product-grid">';
  
  foreach ($array as $registro) {
    echo '<div class="w3-col l4 m6 s12">
            <div class="w3-container product-card">
              <a href="index.php?controlador=productos&action=ver_detalle&codigo=' . htmlspecialchars($registro["codigo"]) . '" class="product-link">
                <img src="uploads/' . htmlspecialchars($registro["imagen"] . ".avif") . '"/>
                <p>' . htmlspecialchars($registro["nombre_producto"]) . '<br>';
                
                // Display prices with discount formatting if applicable
                if($registro['rebajado'] == 1 && isset($registro['precio_rebajado'])) {
                  echo '<span style="text-decoration: line-through; color: #888;">' . htmlspecialchars(number_format($registro['precio'], 2)) . '€</span> 
                        <b class="discount-price">' . htmlspecialchars(number_format($registro['precio_rebajado'], 2)) . '€</b>';
                } else {
                  echo '<b>' . htmlspecialchars(number_format($registro['precio'], 2)) . '€</b>';
                }
                
    echo '</p>
              </a>
              <form method="post" action="index.php?controlador=usuarios&action=almacenar_pedidos">
                <input type="hidden" name="codigo_producto" value="' . htmlspecialchars($registro["codigo"]) . '">
                <input type="number" name="cantidad" value="1" min="1" style="width: 50px;">
                <input type="submit" value="Añadir al carrito" class="w3-button w3-green">
              </form>
            </div>
          </div>';
  }
  
  echo '</div>'; // Cierra product-grid
}

echo '</div>'; // Cierra content-section
echo '</div>'; // Cierra w3-main
?>