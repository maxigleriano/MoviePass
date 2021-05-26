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
                <h2>Editar Cine</h2>

                <form action="<?php echo FRONT_ROOT ?>Theater/modify" method="post">

                    <div class="option-field">
                        <label for="">ID</label>
                        <input class="option" type="text" name="id" value = "<? $theater->getID() ?>" readonly>
                        <span></span>
                    </div>
                    <div class="txt-field">
                        <input type="text" name="name" value = "<? $theater->getName() ?>" required>
                        <span></span>
                        <label for="">Nombre</label>
                    </div>
                    <div class="txt-field">
                        <input type="text" name="address" value = "<? $theater->getAddress() ?>" required>
                        <span></span>
                        <label for="">Dirección</label>
                    </div>
                    <div class="option-field">
                        <label for="">Horario de Apertura</label>
                        <input class="option" type="time" name="openingTime" value = "<? $theater->getOpeningTime() ?>" required>
                        <span></span>
                    </div>
                    <div class="option-field">
                        <label for="">Horario de Cierre</label>
                        <input class="option" type="time" name="closingTime" value = "<? $theater->getClosingTime() ?>" required>
                        <span></span>
                    </div>
                    <input type="submit" value="Aceptar">

                </form>
                
            </div>
        </main>

        <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
        <script src="<?php echo JS_PATH ?>main.js"></script>
    </body>

    <footer>
    


    </footer>
</html>