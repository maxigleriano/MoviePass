<?php require_once(VIEWS_PATH . "nav.php") ?>

<main>
    <div class="contenedor">
        <div class="movie-container">
            <div class="movie-img">
                <img src="<?php echo $movie->getPosterPath()?>" alt="<?php echo $movie->getTitle() ?>">
            </div>

            <div class="movie-details">
                <h3 style="color: #ddd;"> <?php echo $movie->getTitle() ?></h3>
                <p> <?php echo $movie->getOverview() ?> </p>

                <?php echo $trailer ?>
            </div> 
        </div>
        <table class=lista>
            <thead>
                <tr>
                    <th>Cine</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>

            <?php 
                foreach($projectionList as $projection) 
                { 
                    $room = $this->roomDAO->getRoom($projection->getRoomId());
                ?>

                    <tr class="active-row">
                        <td><?php echo $this->theaterDAO->getTheater($room->getTheaterId())->getName() ?></td>
                        <td><?php echo date("d/m/Y", strtotime($projection->getDate())) ?></td>
                        <td><?php echo $projection->getBeginningTime() ?></td>
                        <td><a href="<?php echo FRONT_ROOT ?>Purchase/selectTickets/<?php echo $projection->getId() ?>">Comprar</a></td>
                    </tr>

                <?php } ?>

            </tbody>
        </table>
    </div>
</main>