<?php require_once(VIEWS_PATH."nav.php"); ?>

<main>
<?php if($principalMovie) { ?>

    <div class="pelicula-principal">
        <div class="contenedor">
            <h3 class="titulo"><?php echo $principalMovie->getTitle() ?></h3>
            <p class="descripcion">
                <?php echo $principalMovie->getOverview() ?>
            </p>
            <a href="<?php echo FRONT_ROOT ?>Movie/getMovie/<?php echo $principalMovie->getId() ?>"><button role="button" class="boton"><i class="fas fa-info-circle"></i>Más Información</button></a>
        </div>
    </div>

<?php } ?>

<?php if($movieList) { ?>

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
                        <a href="<?php echo FRONT_ROOT ?>Movie/getMovie/<?php echo $movie->getId()?>"><img src="<?php echo $movie->getBackdropPath()?>" alt="<?php echo $movie->getTitle() ?>"></a>
                    </div>

                <?php } ?>

                </div>
            </div>

            <button role="button" id="flecha-der" class="flecha-der"><i class="fas fa-angle-right"></i></button>
        </div>
    </div>

<?php } ?>
            
</main>
