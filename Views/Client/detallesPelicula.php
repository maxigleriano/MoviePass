<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet"  type="text/css" href="<?php echo CSS_PATH ?>estilos.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
        <title><?php echo $movie->getTitle()?> | MoviePass</title>
    </head>
    
    <body>
        <header>
            <div class="contenedor">
                <h2 class="logotipo">MoviePass</h2>
                <nav>
                    <a href="<?php echo FRONT_ROOT ?>Home/Index">Inicio</a>
                    <a href="<?php echo FRONT_ROOT ?>Home/cartelera">Cartelera</a>
                    <a href="#">Mas Recientes</a>
                    <a href="<?php echo FRONT_ROOT ?>User/logout">Salir</a>
                </nav>
            </div>
        </header>

        <main>
            <div class="contenedor">
                <div class="box">
                    <div class="left">
                        <h2><?php echo $movie->getTitle()?></h2>
                        <img class="foto" src="<?php echo $movie->getPosterPath()?>" alt="<?php echo $movie->getTitle()?>" width="200px" height="300px">
                        <p><?php echo $movie->getOverview()?></p>
                        <?php echo $trailer ?>
                    </div>                
                    <div class="right">
                        <table class=lista>
                            <thead>
                                <tr>
                                    <th>Cine</th>
                                    <th>Sala</th>
                                    <th>Precio</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php 
                                foreach($projectionList as $projection) 
                                { 
                                    $room = $this->roomDAO->getRoom($projection->getRoom());
                            ?>

                                <tr class="active-row">
                                    <td><?php echo $this->theaterDAO->getTheater($room->getTheaterId())->getName() ?></td>
                                    <td><?php echo $room->getName() ?></td>
                                    <td>$<?php echo $room->getTicketValue() ?></td>
                                    <td><?php echo date("d-m-Y", strtotime($projection->getDate())) ?></td>
                                    <td><?php echo $projection->getBeginningTime() ?></td>
                                    <td><a href="<?php echo FRONT_ROOT ?>Purchase/buyTickets/<?php echo $projection->getId() ?>">Comprar</a></td>
                                </tr>

                            <?php } ?>

                            </tbody>
                        </table>
                    </div>                    
                </div>
            </div>
        </main>

        <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
        <script src="<?php echo JS_PATH ?>main.js"></script>
    </body>

    <footer>
    


    </footer>
</html>