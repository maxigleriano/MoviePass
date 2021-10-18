<?php require_once(VIEWS_PATH ."nav.php"); ?>

<main>
    <div class="contenedor">

    <?php foreach($movieList as $movie) { ?>

        <div class="movie-container">
            <div class="movie-img">
                <a href="<?php echo FRONT_ROOT ?>Movie/getMovie/<?php echo $movie->getId()?>">
                    <img src="<?php echo $movie->getPosterPath()?>" alt="<?php echo $movie->getTitle() ?>">
                </a>
            </div>

            <div class="movie-details">
                <h3> <a href="<?php echo FRONT_ROOT ?>Movie/getMovie/<?php echo $movie->getId()?>"><?php echo $movie->getTitle() ?></a></h3>
                <p class="descripcion"> <?php echo $movie->getOverview() ?> </p>
            </div> 
        </div>

    <?php } ?>

    </div>
</main>