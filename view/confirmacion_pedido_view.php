<?php 
require_once('view/navbar_view.php'); 
require_once('view/menu_view.php');
?>

<style>
.confirmation-container {
    max-width: 600px;
    margin: 50px auto;
    padding: 30px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    text-align: center;
}

.confirmation-icon {
    font-size: 64px;
    color: #4CAF50;
    margin-bottom: 20px;
}

.confirmation-title {
    color: #333;
    font-size: 24px;
    margin-bottom: 15px;
}

.confirmation-message {
    color: #666;
    margin-bottom: 30px;
    line-height: 1.6;
}

.confirmation-actions {
    margin-top: 30px;
}

.shop-btn {
    display: inline-block;
    padding: 12px 24px;
    background-color: #4CAF50;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    font-weight: 600;
    transition: background-color 0.3s;
}

.shop-btn:hover {
    background-color: #45a049;
}
</style>

<div class="page-content">
    <div class="confirmation-container">
        <div class="confirmation-icon">
            <i class="fa fa-check-circle"></i>
        </div>
        <h2 class="confirmation-title">¡Pedido Realizado con Éxito!</h2>
        <p class="confirmation-message">
            Gracias por tu compra. Hemos recibido tu pedido y lo estamos procesando.
            Recibirás un correo electrónico con los detalles de tu pedido.
        </p>
        <p>
            Número de pedido: <strong>#<?php echo rand(100000, 999999); ?></strong>
        </p>
        <div class="confirmation-actions">
            <a href="index.php" class="shop-btn">Volver a la Tienda</a>
        </div>
    </div>
</div>

<?php include_once 'footer_view.php'; ?>