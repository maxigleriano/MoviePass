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
                <h2>Agregar Función</h2>

                <form action="<?php echo FRONT_ROOT ?>Projection/addNew" method="post">

                    <div class="option-field">
                        <label for="">Sala</label>
                            <select class="option" name="room" required>
                                <option value="" disabled selected>Seleccione una</option>
                                 
                                <?php foreach($roomList as $room) { ?>
                                
                                <option value="<?php echo $room->getName(); ?>"><?php echo $room->getName(); ?></option>
                                
                                <?php } ?>
                            </select>
                        <span></span>
                    </div>
                    <div class="option-field">
                        <label for="">Película</label>
                            <select class="option" name="movie" required>
                                <option value="" disabled selected>Seleccione una</option>
                                 
                                <?php foreach($movieList as $movie) { ?>
                                
                                <option value="<?php echo $movie; ?>"><?php echo $movie; ?></option>
            
                                <?php } ?>
                            </select>
                        <span></span>
                    </div>
                    <div class="option-field">
                        <label for="">Fecha</label>
                        <input class="option" type="date" name="date" value="" required autocomplete="off">
                        <span></span>
                    </div>
                    <div class="option-field">
                        <label for="">Hora de Inicio</label>
                        <input class="option" type="time" name="time" value="" required autocomplete="off">
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