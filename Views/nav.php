<header>
    <div class="contenedor">
        <span class="logotipo">MoviePass</span>
        <nav>
            <?php if(isset($_SESSION["loggedUser"])) { 
                    if($_SESSION["loggedUser"]->getRole() == 1) { ?>
                        <a href="<?php echo FRONT_ROOT ?>Home/Index">Inicio</a>
                        <a href="<?php echo FRONT_ROOT ?>Home/cartelera">Cartelera</a>
                        <a href="<?php echo FRONT_ROOT ?>Home/admin">Administración</a>
                        <a href="<?php echo FRONT_ROOT ?>User/logout">Salir</a>
                    <?php } else { ?>
                        <a href="<?php echo FRONT_ROOT ?>Home/Index">Inicio</a>
                        <a href="<?php echo FRONT_ROOT ?>Home/cartelera">Cartelera</a>
                        <a href="<?php echo FRONT_ROOT ?>User/logout">Salir</a>
                    <?php } ?>
            <?php } else { ?>
                <a href="<?php echo FRONT_ROOT ?>Home/Index">Inicio</a>
                <a href="<?php echo FRONT_ROOT ?>Home/cartelera">Cartelera</a>
                <a href="<?php echo FRONT_ROOT ?>User/loginView">Entrar</a>
            <?php } ?>
        </nav>
    </div>
</header>
