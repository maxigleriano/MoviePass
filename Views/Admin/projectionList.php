<?php require_once(VIEWS_PATH."nav.php"); ?>

<main style="height:85vh; background-color: #FFF; padding-top: 5vh;">
    <div class="contenedor">
        <h1 style="text-align: center;">FUNCIONES</h1>
        <table class="lista">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cine</th>
                    <th>Sala</th>
                    <th>Pelicula</th>
                    <th>Fecha</th>
                    <th>Hora de Inicio</th>
                    <th>Hora de Fin</th>
                    <th>Disponibles</th>
                    <th>Vendidos</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    if($projectionList) {
                    foreach($projectionList as $projection) {
                        $room = $this->roomDAO->getRoom($projection->getRoomId());
                        $theater = $this->theaterDAO->getTheater($room->getTheaterId());
                        $movie = $this->movieDAO->getMovie($projection->getMovieId());
                ?>
                <tr class="active-row">
                    <td><?php echo $projection->getId() ?></td>
                    <td><?php echo $theater->getName() ?></td>
                    <td><?php echo $room->getName() ?></td>
                    <td><?php echo $movie->getTitle() ?></td>
                    <td><?php echo $projection->getDate() ?></td>
                    <td><?php echo $projection->getBeginningTime() ?></td>
                    <td><?php echo $projection->getEndingTime() ?></td>
                    <td><?php echo $projection->getAvailableSeats() ?></td>         
                    <td><?php echo $projection->getSoldSeats() ?></td>         
                    <td>
                        <form action="#" method="post">
                            <!-- <input type="hidden" name="id" value=""> -->
                            <button class="btn modify" type="submit">Modificar</button>
                        </form>          
                    </td>
                    <td>
                        <form action="#" method="post">
                            <!-- <input type="hidden" name="id" value=""> -->
                            <button class="btn remove" type="submit">Eliminar</button>
                        </form>          
                    </td>
                </tr>
                <?php } }?>                        
        </tbody>
    </table>
    </div> 
</main>
