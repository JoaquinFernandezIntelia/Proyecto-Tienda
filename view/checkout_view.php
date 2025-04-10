<?php 
require_once('view/navbar_view.php'); 
require_once('view/menu_view.php');
?>

<style>
.checkout-container {
    max-width: 800px;
    margin: 30px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.checkout-title {
    text-align: center;
    color: #333;
    margin-bottom: 30px;
    padding-bottom: 15px;
    border-bottom: 1px solid #eee;
}

.checkout-form {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

@media (max-width: 768px) {
    .checkout-form {
        grid-template-columns: 1fr;
    }
}

.form-section {
    margin-bottom: 20px;
}

.form-section h3 {
    margin-bottom: 15px;
    color: #555;
    font-size: 18px;
}

.form-row {
    margin-bottom: 15px;
}

.form-row label {
    display: block;
    margin-bottom: 5px;
    font-weight: 500;
}

.form-row input, 
.form-row select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
}

.phone-input {
    display: flex;
    gap: 10px;
}

.phone-input select {
    width: 120px;
}

.phone-input input {
    flex-grow: 1;
}

.card-fields {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr;
    gap: 10px;
}

.full-width {
    grid-column: 1 / -1;
}

.order-summary {
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 8px;
    margin-top: 20px;
}

.order-summary h3 {
    margin-bottom: 15px;
    color: #333;
}

.summary-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
    padding-bottom: 10px;
    border-bottom: 1px solid #eee;
}

.summary-total {
    display: flex;
    justify-content: space-between;
    font-weight: 700;
    font-size: 18px;
    margin-top: 15px;
    padding-top: 15px;
    border-top: 2px solid #ddd;
}

.checkout-actions {
    margin-top: 30px;
    display: flex;
    justify-content: space-between;
}

.checkout-btn {
    padding: 12px 24px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s;
}

.checkout-btn:hover {
    background-color: #45a049;
}

.back-link {
    padding: 12px 24px;
    background-color: #f0f0f0;
    color: #333;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.back-link:hover {
    background-color: #e0e0e0;
}

.required:after {
    content: " *";
    color: red;
}
</style>

<div class="page-content">
    <div class="checkout-container">
        <h2 class="checkout-title">Finalizar Compra</h2>
        
        <form action="index.php?controlador=usuarios&action=procesar_pedido" method="post" id="checkout-form">
            <div class="checkout-form">
                <!-- Sección de Datos Personales -->
                <div class="form-section">
                    <h3>Datos Personales</h3>
                    
                    <div class="form-row">
                        <label for="nombre" class="required">Nombre</label>
                        <input type="text" id="nombre" name="nombre" required>
                    </div>
                    
                    <div class="form-row">
                        <label for="apellidos" class="required">Apellidos</label>
                        <input type="text" id="apellidos" name="apellidos" required>
                    </div>
                    
                    <div class="form-row">
                        <label for="email" class="required">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="form-row">
                        <label for="telefono" class="required">Teléfono</label>
                        <div class="phone-input">
                            <select id="pais" name="pais" onchange="updatePhonePrefix()">
                                <option value="+34" data-prefix="+34">España</option>
                                <option value="+1" data-prefix="+1">Estados Unidos</option>
                                <option value="+44" data-prefix="+44">Reino Unido</option>
                                <option value="+33" data-prefix="+33">Francia</option>
                                <option value="+49" data-prefix="+49">Alemania</option>
                                <option value="+39" data-prefix="+39">Italia</option>
                                <option value="+351" data-prefix="+351">Portugal</option>
                                <option value="+52" data-prefix="+52">México</option>
                                <option value="+54" data-prefix="+54">Argentina</option>
                                <option value="+56" data-prefix="+56">Chile</option>
                                <option value="+57" data-prefix="+57">Colombia</option>
                                <option value="+58" data-prefix="+58">Venezuela</option>
                            </select>
                            <input type="tel" id="telefono" name="telefono" placeholder="Número de teléfono" required>
                        </div>
                    </div>
                </div>
                
                <!-- Sección de Dirección de Envío -->
                <div class="form-section">
                    <h3>Dirección de Envío</h3>
                    
                    <div class="form-row">
                        <label for="direccion" class="required">Dirección</label>
                        <input type="text" id="direccion" name="direccion" placeholder="Calle, número, piso..." required>
                    </div>
                    
                    <div class="form-row">
                        <label for="ciudad" class="required">Ciudad</label>
                        <input type="text" id="ciudad" name="ciudad" required>
                    </div>
                    
                    <div class="form-row">
                        <label for="provincia" class="required">Provincia</label>
                        <input type="text" id="provincia" name="provincia" required>
                    </div>
                    
                    <div class="form-row">
                        <label for="codigo_postal" class="required">Código Postal</label>
                        <input type="text" id="codigo_postal" name="codigo_postal" required>
                    </div>
                </div>
            </div>
            
            <!-- Sección de Pago -->
            <div class="form-section">
                <h3>Información de Pago</h3>
                
                <div class="form-row">
                    <label for="nombre_tarjeta" class="required">Nombre en la tarjeta</label>
                    <input type="text" id="nombre_tarjeta" name="nombre_tarjeta" required>
                </div>
                
                <div class="form-row">
                    <label for="numero_tarjeta" class="required">Número de tarjeta</label>
                    <input type="text" id="numero_tarjeta" name="numero_tarjeta" placeholder="XXXX XXXX XXXX XXXX" 
                           maxlength="19" onkeyup="formatCardNumber(this)" required>
                </div>
                
                <div class="card-fields">
                    <div class="form-row">
                        <label for="fecha_expiracion" class="required">Fecha de expiración</label>
                        <input type="text" id="fecha_expiracion" name="fecha_expiracion" placeholder="MM/AA" 
                               maxlength="5" onkeyup="formatExpiryDate(this)" required>
                    </div>
                    
                    <div class="form-row">
                        <label for="cvv" class="required">CVV</label>
                        <input type="text" id="cvv" name="cvv" maxlength="4" required>
                    </div>
                </div>
            </div>
            
            <!-- Resumen del Pedido -->
            <div class="order-summary">
                <h3>Resumen del Pedido</h3>
                
                <?php foreach ($_SESSION['carrito'] as $item): 
                    $subtotal = $item['precio'] * $item['cantidad'];
                ?>
                <div class="summary-item">
                    <div>
                        <?php echo htmlspecialchars($item['nombre']); ?> 
                        (<?php echo htmlspecialchars($item['cantidad']); ?> x <?php echo htmlspecialchars($item['precio']); ?>€)
                    </div>
                    <div><?php echo number_format($subtotal, 2); ?>€</div>
                </div>
                <?php endforeach; ?>
                
                <div class="summary-total">
                    <div>Total</div>
                    <div><?php echo number_format($total, 2); ?>€</div>
                </div>
            </div>
            
            <div class="checkout-actions">
                <a href="index.php?controlador=usuarios&action=ver_carrito" class="back-link">Volver al Carrito</a>
                <button type="submit" class="checkout-btn">Realizar Pedido</button>
            </div>
        </form>
    </div>
</div>

<script>
function updatePhonePrefix() {
    var select = document.getElementById('pais');
    var prefix = select.options[select.selectedIndex].getAttribute('data-prefix');
    document.getElementById('telefono').placeholder = prefix + " Número de teléfono";
}

function formatCardNumber(input) {
    // Remove non-digits
    var value = input.value.replace(/\D/g, '');
    
    // Add spaces every 4 digits
    var formattedValue = '';
    for (var i = 0; i < value.length; i++) {
        if (i > 0 && i % 4 === 0) {
            formattedValue += ' ';
        }
        formattedValue += value[i];
    }
    
    input.value = formattedValue;
}

function formatExpiryDate(input) {
    // Remove non-digits
    var value = input.value.replace(/\D/g, '');
    
    // Format as MM/YY
    if (value.length > 2) {
        input.value = value.substring(0, 2) + '/' + value.substring(2);
    } else {
        input.value = value;
    }
}

// Initialize phone prefix
window.onload = function() {
    updatePhonePrefix();
};
</script>

<?php include_once 'footer_view.php'; ?>