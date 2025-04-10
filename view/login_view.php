 <?php
        require_once("view/navbar_view.php");
    ?>
    <div class="page-login">
        <div class="login-container">
            <div class="login-image">
                <img src="images/logo.avif" alt="logo">
            </div>
            <div class="login-form">
                <h2 class="form-title">Bienvenido de nuevo</h2>
                <p class="form-subtitle">Accede a tu cuenta para comenzar a comprar</p>
                
                <form action="" method="post">
                    <div class="form-group">
                        <label for="usuario" class="form-label">USUARIO</label>
                        <input type="text" class="form-input" placeholder="Ingresa tu nombre de usuario" name="usuario" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password" class="form-label">CONTRASEÑA</label>
                        <input type="password" class="form-input" placeholder="Ingresa tu contraseña" name="password" required>
                    </div>
                    
                    <div class="remember-forgot">
                        <div class="remember-me">
                            <input type="checkbox" class="remember-checkbox" id="remember" name="remember">
                            <label for="remember">Recordarme</label>
                        </div>
                        <a href="#" class="forgot-password">¿Olvidaste tu contraseña?</a>
                    </div>
                    
                    <input type="submit" name="submit" value="Iniciar Sesión" class="form-button">
                    
                    <div class="login-footer">
                        ¿No tienes una cuenta? <a href="#" class="signup-link">Regístrate ahora</a>
                    </div>
                </form>
                
                <?php if(isset($message) && !empty($message)): ?>
    <div class="error-message">
        <?php echo $message; ?>
    </div>
<?php endif; ?>

            </div>
        </div>
    </div>
