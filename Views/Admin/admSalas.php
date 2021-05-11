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
            <div class="contenedor">
                <div class="box">
                    <h2>Administrar Salas</h2>
                    <a href="<?php echo FRONT_ROOT ?>Room/addView">Agregar</br></a>
                    <a href="#">Editar</br></a>
                    <a href="#">Borrar</br></a>
                    <a href="#">Listar</br></a>
                </div>
            </div>
        </main>

        <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
        <script src="<?php echo JS_PATH ?>main.js"></script>
    </body>

    <footer>
    


    </footer>
</html>