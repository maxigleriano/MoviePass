<?php require_once(VIEWS_PATH."nav.php"); ?>

<main>
    <div class="form-box">
        <h2>Agregar Cine</h2>
        <form action="<?php echo FRONT_ROOT ?>Theater/addNew" method="post">
            <!-- NAME INPUT -->
            <label for="name">Nombre</label>
            <input type="text" name="name" required autocomplete="off">
             <!-- ADDRES INPUT -->
            <label for="address">Dirección</label>
            <input type="text" name="address" required autocomplete="off">
            <!-- OPENING TIME INPUT -->
            <label for="openingTime">Horario de Apertura</label>
            <input type="time" name="openingTime" required autocomplete="off">
            <!-- CLOSING TIME INPUT -->
            <label for="closingTime">Horario de Cierre</label>
            <input type="time" name="closingTime" required autocomplete="off">

            <input type="submit" value="Agregar">
        </form>
    </div>
</main>
