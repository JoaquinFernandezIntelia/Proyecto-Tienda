<!DOCTYPE html>
<html>

<head>
  <title>W3.CSS Template</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="css/normallize.css">
  <link rel="stylesheet" href="css/navbar.css">
  <link rel="stylesheet" href="css/sidebar.css">
  <link rel="stylesheet" href="css/content.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="css/login.css">
  <link rel="stylesheet" href="css/carrito.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="js/ajax.js" defer></script>

  <style>
    /* ================= GLOBAL STYLES ================= */
    :root {
  --primary-color: #3498db;
  --secondary-color: #2c3e50;
  --accent-color: #e74c3c;
  --text-color: #333;
  --light-gray: #f5f5f5;
  --medium-gray: #ddd;
  --dark-gray: #555;
  --box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  --hover-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
  --transition-speed: 0.3s ease;
  --card-height: 360px; /* Reduced height since we removed the cart form */
  --image-height: 220px;
}


    html,
    body {
      margin: 0;
      padding: 0;
      font-family: 'Montserrat', sans-serif;
      color: var(--text-color);
      background-color: var(--light-gray);
      line-height: 1.6;
      scroll-behavior: smooth;
    }
  </style>
</head>

<body class="w3-content">
  <?php
  require_once('controller/front_controller.php');
  ?>
  
    <?php
    require_once('view/footer_view.php');
    ?>
<script>
  var open = false;

  function toggleNavbarMenu() {
    var sidebar = document.getElementById("sidebarMenu");
    var pageContent = document.querySelector(".page-content");
    var footer = document.querySelector(".footer-section");
    var overlay = document.getElementById("myOverlay");

    if (!open) {
        sidebar.classList.remove("sidebar-open");
        sidebar.classList.add("sidebar-closed");
        pageContent.classList.add("sidebar-hidden"); // Ajusta el contenido
        if (footer) footer.classList.add("sidebar-hidden"); // Ajusta el footer
        
        // Only activate overlay for small screens
        if (window.innerWidth < 993) {
            overlay.classList.add("active");
        }
        
        open = true;
    } else {
        sidebar.classList.remove("sidebar-closed");
        sidebar.classList.add("sidebar-open");
        pageContent.classList.remove("sidebar-hidden"); // Restaura el contenido
        if (footer) footer.classList.remove("sidebar-hidden"); // Restaura el footer
        overlay.classList.remove("active");
        open = false;
    }
    
    // Force a layout recalculation to ensure proper rendering
    setTimeout(function() {
        window.dispatchEvent(new Event('resize'));
    }, 300);
  }

  function toggleSidebarMenuDropdown(dropdownId, buttonId) {
    var dropdown = document.getElementById(dropdownId);
    var button = document.getElementById(buttonId);

    button.classList.toggle("active");
    dropdown.classList.toggle("sidebar-hide");
  }

  function closeSidebarMenu() {
    var sidebar = document.getElementById("sidebarMenu");
    var pageContent = document.querySelector(".page-content");
    var footer = document.querySelector(".footer-section");
    var overlay = document.getElementById("myOverlay");
    
    sidebar.classList.add("sidebar-closed");
    sidebar.classList.remove("sidebar-open");
    pageContent.classList.add("sidebar-hidden");
    if (footer) footer.classList.add("sidebar-hidden");
    overlay.classList.remove("active");
    open = true;
  }

  function openSidebarMenu() {
    var sidebar = document.getElementById("sidebarMenu");
    var pageContent = document.querySelector(".page-content");
    var footer = document.querySelector(".footer-section");
    var overlay = document.getElementById("myOverlay");
    
    sidebar.classList.remove("sidebar-closed");
    sidebar.classList.add("sidebar-open");
    pageContent.classList.remove("sidebar-hidden");
    if (footer) footer.classList.remove("sidebar-hidden");
    overlay.classList.remove("active");
    open = false;
  }
</script>
</body>
</html>