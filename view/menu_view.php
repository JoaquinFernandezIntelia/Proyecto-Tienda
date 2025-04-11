<!-- menu_view.php -->
<?php
// Siempre inicializar el modelo de categorías
require_once("model/productos_model.php");
$modeloCategorias = new Productos_model();

// Obtener todas las categorías generales si no están ya cargadas
if (!isset($categorias_generales)) {
  $categorias_generales = $modeloCategorias->get_categorias_generales();
}
?>

<!-- Sidebar/menu -->
<nav class="sidebar-menu sidebar-block sidebar-light sidebar-collapsed sidebar-top-fixed" id="sidebarMenu">
  <div class="sidebar-content sidebar-padding-small">
    <a href="index.php"><img src="images/logo.avif" alt="logo.avif"></a>
  </div>
  <div class="sidebar-padding-large sidebar-large sidebar-text-dark">
    <?php foreach ($categorias_generales as $catGeneral): ?>
      <?php 
        $dropdownId = 'dropdown' . str_replace(' ', '', $catGeneral['nombre_catgeneral']);
        $btnId = 'btn' . str_replace(' ', '', $catGeneral['nombre_catgeneral']);
        $subcategorias = $modeloCategorias->get_categorias_por_general($catGeneral['codigo_catgeneral']);
      ?>
      
      <a onclick="toggleSidebarMenuDropdown('<?php echo $dropdownId; ?>', '<?php echo $btnId; ?>')" href="javascript:void(0)" class="sidebar-menu-item sidebar-menu-button sidebar-align-left" id="<?php echo $btnId; ?>">
        <?php echo strtoupper($catGeneral['nombre_catgeneral']); ?> <i class="fa fa-chevron-right sidebar-dropdown-arrow"></i>
      </a>
      <div id="<?php echo $dropdownId; ?>" class="sidebar-menu-dropdown">
        <?php if(!empty($subcategorias)): ?>
          <?php foreach($subcategorias as $subcat): ?>
            <a href="index.php?controlador=productos&action=ver_categoria&categoria=<?php echo $subcat['codigo_categoria']; ?>" class="sidebar-menu-item sidebar-menu-button">
              <?php echo strtoupper($subcat['nombre_categoria']); ?>
            </a>
          <?php endforeach; ?>
        <?php else: ?>
          <a href="#" class="sidebar-menu-item sidebar-menu-button">SIN SUBCATEGORÍAS</a>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
    
    <!-- Enlace para ver todos los productos -->
    <a href="index.php?controlador=productos&action=ver_categoria" class="sidebar-menu-item sidebar-menu-button">TODOS LOS PRODUCTOS</a>
  </div>
  <a href="#footer" class="sidebar-menu-item sidebar-menu-button sidebar-padding">CONTACTO</a>
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large overlay-small-screen" onclick="closeSidebarMenu()" title="close side menu" id="myOverlay"></div>