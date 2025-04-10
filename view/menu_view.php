<!-- menu_view.php -->


<!-- Sidebar/menu -->
<nav class="sidebar-menu sidebar-block sidebar-light sidebar-collapsed sidebar-top-fixed" id="sidebarMenu">
  <div class="sidebar-content sidebar-padding-small">
    <a href="index.php"><img src="images/logo.avif" alt="logo.avif"></a>
  </div>
  <div class="sidebar-padding-large sidebar-large sidebar-text-dark">
    <a onclick="toggleSidebarMenuDropdown('dropdownElectronics', 'btnElectronics')" href="javascript:void(0)" class="sidebar-menu-item sidebar-menu-button sidebar-align-left" id="btnElectronics">
      ELECTRONICA <i class="fa fa-chevron-right sidebar-dropdown-arrow"></i>
    </a>
    <div id="dropdownElectronics" class="sidebar-menu-dropdown">
      <a href="#" class="sidebar-menu-item sidebar-menu-button sidebar-light-background">MONITORES</a>
      <a href="#" class="sidebar-menu-item sidebar-menu-button">PERIFERICOS</a>
      <a href="index.php?controlador=productos&action=componentes" class="sidebar-menu-item sidebar-menu-button">COMPONENTES</a>
      <a href="#" class="sidebar-menu-item sidebar-menu-button">DISEÑA TU EQUIPO</a>
    </div>
    <a onclick="toggleSidebarMenuDropdown('dropdownAppliances', 'btnAppliances')" href="javascript:void(0)" class="sidebar-menu-item sidebar-menu-button sidebar-align-left" id="btnAppliances">
      ELECTRODOMESTICOS <i class="fa fa-chevron-right sidebar-dropdown-arrow"></i>
    </a>
    <div id="dropdownAppliances" class="sidebar-menu-dropdown">
      <a href="#" class="sidebar-menu-item sidebar-menu-button sidebar-light-background">HORNOS</a>
      <a href="#" class="sidebar-menu-item sidebar-menu-button">AIRES ACONDICIONADOS</a>
      <a href="#" class="sidebar-menu-item sidebar-menu-button">FRIGORÍFICOS</a>
      <a href="#" class="sidebar-menu-item sidebar-menu-button">LAVADORAS</a>
    </div>

    <a onclick="toggleSidebarMenuDropdown('dropdownHome', 'btnHome')" href="javascript:void(0)" class="sidebar-menu-item sidebar-menu-button sidebar-align-left" id="btnHome">
      PARA TU HOGAR <i class="fa fa-chevron-right sidebar-dropdown-arrow"></i>
    </a>
    <div id="dropdownHome" class="sidebar-menu-dropdown">
      <a href="#" class="sidebar-menu-item sidebar-menu-button sidebar-light-background">JARDIN</a>
      <a href="#" class="sidebar-menu-item sidebar-menu-button">SOFAS</a>
      <a href="#" class="sidebar-menu-item sidebar-menu-button">MUEBLES</a>
      <a href="#" class="sidebar-menu-item sidebar-menu-button">DECORACIÓN</a>
    </div>

    <a onclick="toggleSidebarMenuDropdown('dropdownJewelry', 'btnJewelry')" href="javascript:void(0)" class="sidebar-menu-item sidebar-menu-button sidebar-align-left" id="btnJewelry">
      BISUTERIA <i class="fa fa-chevron-right sidebar-dropdown-arrow"></i>
    </a>
    <div id="dropdownJewelry" class="sidebar-menu-dropdown">
      <a href="#" class="sidebar-menu-item sidebar-menu-button sidebar-light-background">COLLARES</a>
      <a href="#" class="sidebar-menu-item sidebar-menu-button">ANILLOS</a>
      <a href="#" class="sidebar-menu-item sidebar-menu-button">ACCESORIOS</a>
    </div>
    <a href="#" class="sidebar-menu-item sidebar-menu-button">FARMACIA</a>
    <a href="#" class="sidebar-menu-item sidebar-menu-button">JARDINERIA</a>
  </div>
  <a href="#footer" class="sidebar-menu-item sidebar-menu-button sidebar-padding">CONTACTO</a>
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large overlay-small-screen" onclick="closeSidebarMenu()" title="close side menu" id="myOverlay"></div>