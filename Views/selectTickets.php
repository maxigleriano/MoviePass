<?php require_once(VIEWS_PATH . "nav.php") ?>

<main>
    <div class="form-box">
        <h2>Cantidad de Entradas</h2>
        <form action="<?php echo FRONT_ROOT ?>Purchase/buyTickets" method="post">
            <input type="number" name="tickets" min=1 max=<?php echo $projection->getAvailableSeats() ?> required>

            <input type="submit" value="Aceptar">
        </form>
    </div> 
</main>
