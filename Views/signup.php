<?php require_once(VIEWS_PATH."nav.php"); ?>

<main>
    <div class="form-box">
        <h2>Registrarse</h2>
        <form action="<?php echo FRONT_ROOT ?>User/addNewUser" method="post">
            <!-- NAME INPUT -->
            <label for="name">Nombre</label>
            <input type="text" name="name" required autocomplete="off">
            <!-- LASTNAME INPUT -->
            <label for="lastName">Apellido</label>
            <input type="text" name="lastName" required autocomplete="off">
            <!-- EMAIL INPUT -->
            <label for="email">Email</label>
            <input type="email" name="email" required autocomplete="off">
            <!-- PASSWORD INPUT -->
            <label for="password">Contraseña</label>
            <input type="password" name="password" required autocomplete="off">
            <!-- BIRTHDATE INPUT -->
            <label for="birthDate">Fecha de Nacimiento</label>
            <input type="date" name="birthDate" required autocomplete="off">

            <input type="submit" value="Aceptar">
        </form>
    </div>
</main>