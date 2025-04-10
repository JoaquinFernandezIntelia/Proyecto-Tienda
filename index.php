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
      --text-color: #2c3e50;
      --light-gray: #f8f9fa;
      --medium-gray: #e9ecef;
      --dark-gray: #343a40;
      --transition-speed: 0.3s;
      --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      --hover-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
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
        footer.classList.add("sidebar-hidden"); // Ajusta el footer
        overlay.classList.add("active");
        open = true;
    } else {
        sidebar.classList.remove("sidebar-closed");
        sidebar.classList.add("sidebar-open");
        pageContent.classList.remove("sidebar-hidden"); // Restaura el contenido
        footer.classList.remove("sidebar-hidden"); // Restaura el footer
        overlay.classList.remove("active");
        open = false;
    }
}

  function toggleSidebarMenuDropdown(dropdownId, buttonId) {
    var dropdown = document.getElementById(dropdownId);
    var button = document.getElementById(buttonId);

    button.classList.toggle("active");
    dropdown.classList.toggle("sidebar-hide");
  }

  function closeSidebarMenu() {
    document.getElementById("sidebarMenu").classList.add("sidebar-closed");
  }

  function openSidebarMenu() {
    document.getElementById("sidebarMenu").classList.remove("sidebar-closed");
  }

  
</script>
</body>
</html>