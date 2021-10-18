<?php require_once(VIEWS_PATH."nav.php"); ?>

<main>
    <div class="form-box">
        <h2>Editar Sala</h2>
        <form action="<?php echo FRONT_ROOT ?>Room/modify" method="post">
            <!-- ID INPUT -->
            <label for="id">ID Sala</label>
            <input type="number" name="id" value="<?php echo $room->getID() ?>" readonly>
            <!-- THEATER INPUT -->
            <label for="theaterId">ID Cine</label>
            <input type="number" name="theaterId" value="<?php echo $room->getTheaterId() ?>" readonly>
            <!-- NAME INPUT -->
            <label for="name">Nombre</label>
            <input type="text" name="name" value="<?php echo $room->getName() ?>" required>
            <!-- CAPACITY INPUT -->
            <label for="capacity">Capacidad</label>
            <input type="number" min="1" name="capacity" value="<?php echo $room->getCapacity() ?>" required>
            <!-- VALUE INPUT -->
            <label for="ticketValue">Valor de Entrada</label>
            <input type="number" min="1" name="ticketValue" value="<?php echo $room->getTicketValue() ?>" required>

            <input type="submit" value="Aceptar">
        </form>
    </div>
</main>
