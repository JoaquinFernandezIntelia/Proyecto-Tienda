<?php
require_once('view/menu_view.php');
require_once('view/navbar_view.php');
echo '<div class="w3-main page-content">
<div class="w3-hide-large content-push-small"></div>
<div class="content-section">
 <header class="w3-container w3-xlarge top-header">
    <p class="w3-left">Componentes</p>
    <p class="w3-right">
      <i class="fa fa-shopping-cart w3-margin-right"></i>
      <i class="fa fa-search"></i>
    </p>
  </header>
   <div class="w3-row w3-grayscale product-grid">';

$columnas = count($array);
$total_productos = count($array);
$productos_por_columna = ceil($total_productos / $columnas);

// Crear las columnas
for ($i = 0; $i < $columnas; $i++) {
  echo '<div class="w3-col l4 s6 product-item">'; // Cambiar l3 a l4 para 3 columnas

  // Agregar productos a esta columna
  for ($j = 0; $j < $productos_por_columna; $j++) {
    $index = $i * $productos_por_columna + $j;

    // Verificar si hay productos disponibles en este índice
    if ($index < $total_productos) {
      $registro = $array[$index];

      echo '<div class="w3-container">
               <img src="uploads/' . htmlspecialchars($registro["imagen"] . ".avif") . '"/>
               <p>' . $registro["nombre_producto"] . '<br><b>' . $registro["precio"] . '€</b></p>
               <form method="post" action="index.php?controlador=usuarios&action=almacenar_pedidos">
                   <input type="hidden" name="codigo_producto" value="' . htmlspecialchars($registro["codigo"]) . '">
                   <input type="number" name="cantidad" value="1" min="1" style="width: 50px;">
                   <input type="submit" value="Añadir al carrito" class="w3-button w3-green">
               </form>
            </div>';
    }
  }

  echo '</div>'; // Cierra la columna
}

echo '</div>'; // Cierra product-grid
echo '</div>'; // Cierra content-section
echo '</div>'; // Cierra w3-main