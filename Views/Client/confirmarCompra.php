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
                <h2>Confirmar Compra</h2>

                <form action="<?php echo FRONT_ROOT ?>Purchase/completePurchase/" method="post">

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
                        <label for="">Valor de la Entrada</label>
                        <p class="option"><?php echo $room->getTicketValue() ?></p>
                        <span></span>
                    </div>
                    <div class="option-field">
                        <label for="">Cantidad de Entradas</label>
                        <p class="option"><?php echo $tickets ?></p>
                        <span></span>
                    </div>
                    <div class="option-field">
                        <label for="">Total</label>
                        <p class="option"><?php echo $total ?></p>
                        <span></span>
                    </div>
                    <script
                        src="https://www.mercadopago.com.ar/integrations/v1/web-tokenize-checkout.js"
                        data-public-key="<?php echo ACCESS_TOKEN ?>"
                        data-transaction-amount="<?php echo $total ?>"
                        data-button-label="Pagar"
                    >
				    </script>

                </form>
                
            </div>
        </main>

        <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
        <script src="<?php echo JS_PATH ?>main.js"></script>
    </body>

    <footer>
    


    </footer>
</html>