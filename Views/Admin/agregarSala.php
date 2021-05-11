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
                    <a href="<?php echo FRONT_ROOT ?>Home/Index">Inicio</a>
                    <a href="<?php echo FRONT_ROOT ?>Home/cartelera">Cartelera</a>
                    <a href="#">Mas Recientes</a>
                    <a href="<?php echo FRONT_ROOT ?>Home/administrar" class="activo">Administración</a>
                    <a href="<?php echo FRONT_ROOT ?>User/logout">Salir</a>
                </nav>
            </div>
        </header>

        <main>
            <div class="mini-contenedor">
                <h2>Agregar Sala</h2>

                <form action="<?php echo FRONT_ROOT ?>Room/addNew" method="post">

                    <div class="txt-field">
                        <input type="text" name="name" value="" required autocomplete="off">
                        <span></span>
                        <label for="">Nombre</label>
                    </div>
                    <div class="txt-field">
                        <input type="number" name="capacity" value="" required autocomplete="off">
                        <span></span>
                        <label for="">Capacidad</label>
                    </div>
                    <div class="txt-field">
                        <input type="number" name="ticketValue" value="" required autocomplete="off">
                        <span></span>
                        <label for="">Precio</label>
                    </div>
                    <div class="option-field">
                        <label for="">Cine</label>
                        <select class="option" name="theater" required>
                            <option value="" disable selected>Seleccione uno</option>

                            <?php foreach($theaterList as $theater) { ?>

                            <option value="<?php echo $theater->getName(); ?>"><?php echo $theater->getName(); ?></option>

                            <?php } ?>
                        </select>
                        <span></span>
                    </div>
                    <input type="submit" value="Agregar">

                </form>
                
            </div>
        </main>

        <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
        <script src="<?php echo JS_PATH ?>main.js"></script>
    </body>

    <footer>
    


    </footer>
</html>