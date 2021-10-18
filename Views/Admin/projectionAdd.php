<?php require_once(VIEWS_PATH."nav.php"); ?>

<main>
    <div class="form-box">
        <h2>Agregar Funcion</h2>
        <form action="<?php echo FRONT_ROOT ?>Projection/addNew" method="post">
            <!-- ROOM INPUT -->
            <label for="roomId">Sala</label>
            <select name="roomId" required>
                <option disabled selected>Seleccione una</option>
                             
                <?php foreach($roomList as $room) { ?>
                            
                <option value="<?php echo $room->getId(); ?>"><?php echo $this->theaterDAO->getTheater($room->getTheaterId())->getName() . " - " . $room->getName(); ?></option>
                            
                <?php } ?>
            </select>
            <!-- MOVIE INPUT -->
            <label for="movieId">Película</label>
            <select name="movieId" required>
                <option disabled selected>Seleccione una</option>
                         
                <?php foreach($movieList as $movie) { ?>
                                
                <option value="<?php echo $movie->getId(); ?>"><?php echo $movie->getTitle(); ?></option>
        
                <?php } ?>
            </select>
            <!-- DATE INPUT -->
            <label for="date">Fecha</label>
            <input type="date" name="date" required autocomplete="off">
            <!-- TIME INPUT -->
            <label for="beginningTime">Hora de Inicio</label>
            <input type="time" name="beginningTime" required autocomplete="off">

            <input type="submit" value="Agregar">
        </form>
    </div>
</main>
