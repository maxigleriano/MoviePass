<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet"  type="text/css" href="<?php echo CSS_PATH ?>estilos.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
        <title>Cartelera | MoviePass</title>
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
            <div class="mini-contenedor">
                <h2>Comprar Entradas</h2>

                <form action="<?php echo FRONT_ROOT ?>Purchase/confirmPurchase/" method="post">

                    <div class="option-field">
                        <label for="">Sala</label>
                        <p class="option"><?php echo $room->getName() ?></p>
                        <span></span>
                    </div>
                    <div class="option-field">
                        <label for="">Pelicula</label>
                        <p class="option"><?php echo $movie->getTitle() ?></p>
                        <span></span>
                    </div>
                    <div class="option-field">
                        <label for="">Fecha</label>
                        <p class="option"><?php echo $projection->getDate() ?></p>
                        <span></span>
                    </div>
                    <div class="option-field">
                        <label for="">Hora de Inicio</label>
                        <p class="option"><?php echo $projection->getBeginningTime() ?></p>
                        <span></span>
                    </div>
                    <div class="option-field">
                        <label for="">Valor de la Entrada   </label>
                        <p class="option"><?php echo $room->getTicketValue() ?></p>
                        <span></span>
                    </div>
                    <div class="txt-field">
                        <input type="number" name="tickets" value="" min=1 max=<?php echo $projection->getAvailableSeats() ?> required>
                        <label for="">Numero de Entradas</label>
                        <span></span>
                    </div>
                    <input type="submit" value="Continuar">

                </form>
                
            </div>
        </main>

        <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
        <script src="<?php echo JS_PATH ?>main.js"></script>
    </body>

    <footer>
    


    </footer>
</html>