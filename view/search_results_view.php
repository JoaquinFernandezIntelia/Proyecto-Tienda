<?php 
include_once 'view/navbar_view.php';
include_once 'view/menu_view.php';

?>

<style>
    .search-results-container {
        padding: 40px 0;
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .search-title {
        text-align: center;
        margin-bottom: 30px;
        color: #333;
        font-weight: 500;
        border-bottom: 2px solid #eaeaea;
        padding-bottom: 15px;
    }
    
    .search-term {
        color: #007bff;
        font-weight: 600;
    }
    
    .no-results {
        text-align: center;
        padding: 30px;
        background-color: #f8f9fa;
        border-radius: 5px;
        margin: 20px auto;
        max-width: 600px;
        color: #6c757d;
        font-size: 18px;
    }
    
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }
    
    .product-card {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background: white;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.15);
    }
    
    .product-image {
        height: 200px;
        overflow: hidden;
        position: relative;
    }
    
    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .product-card:hover .product-image img {
        transform: scale(1.05);
    }
    
    .product-details {
        padding: 15px;
    }
    
    .product-name {
        font-weight: 600;
        font-size: 18px;
        margin-bottom: 8px;
        color: #333;
        height: 50px;
        overflow: hidden;
    }
    
    .product-price {
        font-size: 22px;
        color: #e63946;
        font-weight: 700;
        margin-bottom: 10px;
    }
    
    .product-description {
        color: #6c757d;
        font-size: 14px;
        margin-bottom: 15px;
        height: 60px;
        overflow: hidden;
    }
    
    .view-button {
        display: block;
        width: 100%;
        padding: 10px;
        background-color: #333;
        color: white;
        text-align: center;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        text-decoration: none;
        font-weight: 500;
    }
    
    .view-button:hover {
        background-color: #222;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .products-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 480px) {
        .products-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
<div class="page-content">
<div class="search-results-container">
    <h2 class="search-title">Resultados de búsqueda para: "<span class="search-term"><?php echo htmlspecialchars($_GET['search']); ?></span>"</h2>
    
    <?php if (empty($resultados)): ?>
        <div class="no-results">
            <i class="fa fa-search" style="font-size: 32px; margin-bottom: 15px; color: #adb5bd;"></i>
            <p>No se encontraron productos que coincidan con su búsqueda.</p>
            <p>Intente con otro término o revise la ortografía.</p>
        </div>
    <?php else: ?>
        <div class="products-grid">
            <?php foreach ($resultados as $producto): ?>
                <div class="product-card">
                    <div class="product-image">
                        <img src="uploads/<?php echo htmlspecialchars($producto['imagen']); ?>.avif" alt="<?php echo htmlspecialchars($producto['nombre_producto']); ?>">
                    </div>
                    <div class="product-details">
                        <h4 class="product-name"><?php echo htmlspecialchars($producto['nombre_producto']); ?></h4>
                        <p class="product-price"><?php echo htmlspecialchars($producto['precio']); ?>€</p>
                        <p class="product-description"><?php echo htmlspecialchars(substr($producto['descripcion'], 0, 100)); ?><?php echo (strlen($producto['descripcion']) > 100 ? '...' : ''); ?></p>
                        <a href="index.php?controlador=productos&action=ver_detalle&codigo=<?php echo htmlspecialchars($producto['codigo']); ?>" class="view-button">Ver detalle</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
</div>