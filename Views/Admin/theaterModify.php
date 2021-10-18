<?php require_once(VIEWS_PATH."nav.php"); ?>

<main>
    <div class="form-box">
        <h2>Editar Cine</h2>
        <form action="<?php echo FRONT_ROOT ?>Theater/modify" method="post">
            <!-- ID INPUT -->
            <label for="id">ID</label>
            <input type="number" name="id" value="<?php echo $theater->getId() ?>" readonly>
            <!-- NAME INPUT -->
            <label for="name">Nombre</label>
            <input type="text" name="name" value="<?php echo $theater->getName() ?>" required>
            <!-- ADDRES INPUT -->
            <label for="address">Dirección</label>
            <input type="text" name="address" value="<?php echo $theater->getAddress() ?>" required>
            <!-- OPENING TIME INPUT -->
            <label for="openingTime">Horario de Apertura</label>
            <input type="time" name="openingTime" value="<?php echo $theater->getOpeningTime() ?>" required>
            <!-- CLOSING TIME INPUT -->
            <label for="closingTime">Horario de Cierre</label>
            <input type="time" name="closingTime" value="<?php echo $theater->getClosingTime() ?>" required>

            <input type="submit" value="Aceptar">
        </form>
    </div>
</main>
