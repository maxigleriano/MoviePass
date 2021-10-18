<?php require_once(VIEWS_PATH."nav.php"); ?>

<main>
    <div class="form-box">
        <h2>Agregar Sala</h2>
        <form action="<?php echo FRONT_ROOT ?>Room/addNew" method="post">
            <!-- NAME INPUT -->
            <label for="name">Nombre</label>
            <input type="text" name="name" required autocomplete="off">
            <!-- CAPACITY INPUT -->
            <label for="capacity">Capacidad</label>
            <input type="number" name="capacity" min="1" required autocomplete="off">
            <!-- PRICE INPUT -->
            <label for="ticketValue">Precio</label>
            <input type="number" name="ticketValue" min="1" required autocomplete="off">
            <!-- THEATER INPUT -->
            <label for="theaterId">Cine</label>
            <select class="option" name="theaterId" required>
                <option disable selected>Seleccione uno</option>

                <?php foreach($theaterList as $theater) { ?>

                <option value="<?php echo $theater->getId(); ?>"><?php echo $theater->getName(); ?></option>

                <?php } ?>
            </select>

            <input type="submit" value="Agregar">
        </form>
    </div>
</main>
