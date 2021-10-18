<?php require_once(VIEWS_PATH."nav.php"); ?>

<main>
    <div class="form-box">
        <h2>Iniciar Sesión</h2>
        <form action="<?php echo FRONT_ROOT ?>User/login" method="post">
            <!-- EMAIL INPUT -->
            <label for="email">Email</label>
            <input type="email" name="email" required>
            <!-- PASSWORD INPUT -->
            <label for="password">Contraseña</label>
            <input type="password" name="password" required>

            <input type="submit" value="Entrar">
            
            <a href="#">¿Olvidaste tu contraseña?</a><br>
            <a href="<?php echo FRONT_ROOT ?>User/signup">Registrarse</a>
        </form>
    </div>    
</main>