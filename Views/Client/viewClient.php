<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet"  type="text/css" href="<?php echo CSS_PATH ?>estilos.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
        <title>MoviePass</title>
    </head>
    
    <body>
        <header>
            <div class="contenedor">
                <h2 class="logotipo">MoviePass</h2>
                <nav>
                    <a href="<?php echo FRONT_ROOT ?>User/viewClient" class="activo">Inicio</a>
                    <a href="<?php echo FRONT_ROOT ?>Home/carteleraCliente">Cartelera</a>
                    <a href="#">Mas Recientes</a>
                    <a href="<?php echo FRONT_ROOT ?>User/logout">Salir</a>
                </nav>
            </div>
        </header>

        <main>
        <main>
            <div class="pelicula-principal">
                <div class="contenedor">
                    <h3 class="titulo">Interestelar</h3>
                    <p class="descripcion">
                        Narra las aventuras de un grupo de exploradores que hacen uso de un agujero de gusano recientemente descubierto para superar las limitaciones de los viajes espaciales tripulados y vencer las inmensas distancias que tiene un viaje interestelar.
                    </p>
                    <button role="button" class="boton"><i class="fas fa-play"></i>Reproducir</button>
                    <button role="button" class="boton"><i class="fas fa-info-circle"></i>Más Información</button>
                </div>
            </div>

            <div class="peliculas-recomendadas contenedor">
                <div class="contenedor-titulo-controles">
                    <h3>Películas en Cartelera</h3>
                    <div class="indicadores"></div>
                </div>
    
                <div class="contenedor-principal">
                    <button role="button" id="flecha-izq" class="flecha-izq"><i class="fas fa-angle-left"></i></button>
    
                    <div class="contenedor-carousel">
                        <div class="carousel">

                        <?php foreach($movieList as $movie) { ?>

                            <div class="pelicula">
                                <a href="#"><img src="<?php echo $movie->getBackdropPath()?>" alt="<?php echo $movie->getTitle() ?>"></a>
                            </div>

                        <?php } ?>

                        </div>
                    </div>
    
                    <button role="button" id="flecha-der" class="flecha-der"><i class="fas fa-angle-right"></i></button>
                </div>
            </div>
        </main>

        <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
        <script src="<?php echo JS_PATH ?>main.js"></script>
    </body>

    <footer>
    


    </footer>
</html>