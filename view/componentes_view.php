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
</style>
<?php
require_once('view/menu_view.php');
require_once('view/navbar_view.php');
echo '<div class="w3-main page-content">
<div class="w3-hide-large content-push-small"></div>
<div class="content-section">
 <header class="w3-container w3-xlarge top-header">
    <p class="w3-left">Componentes</p>
  </header>
   <div class="w3-row w3-grayscale product-grid">';

$columnas = count($array);
$total_productos = count($array);
$productos_por_columna = ceil($total_productos / $columnas);

// Crear las columnas
for ($i = 0; $i < $columnas; $i++) {

  // Agregar productos a esta columna
  for ($j = 0; $j < $productos_por_columna; $j++) {
    $index = $i * $productos_por_columna + $j;

    // Verificar si hay productos disponibles en este índice
    if ($index < $total_productos) {
      $registro = $array[$index];

      echo '<div class="w3-container product-card">
               <a href="index.php?controlador=productos&action=ver_detalle&codigo=' . htmlspecialchars($registro["codigo"]) . '" class="product-link">
                 <img src="uploads/' . htmlspecialchars($registro["imagen"] . ".avif") . '"/>
                 <p>' . $registro["nombre_producto"] . '<br><b>' . $registro["precio"] . '€</b></p>
               </a>
               <form method="post" action="index.php?controlador=usuarios&action=almacenar_pedidos">
                   <input type="hidden" name="codigo_producto" value="' . htmlspecialchars($registro["codigo"]) . '">
                   <input type="number" name="cantidad" value="1" min="1" style="width: 50px;">
                   <input type="submit" value="Añadir al carrito" class="w3-button w3-green">
               </form>
            </div>';
    }
  }

}

echo '</div>'; // Cierra product-grid
echo '</div>'; // Cierra content-section
echo '</div>'; // Cierra w3-main