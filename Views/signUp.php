<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet"  type="text/css" href="<?php echo CSS_PATH ?>estilos.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
        <title>Registrarse</title>
    </head>
    
    <body>
        <header>
            <div class="contenedor">
                <h2 class="logotipo">MoviePass</h2>
                <nav>
                    <a href="<?php echo FRONT_ROOT ?>Home/Index">Inicio</a>
                    <a href="<?php echo FRONT_ROOT ?>Home/cartelera">Cartelera</a>
                    <a href="#">Mas Recientes</a>
                    <a href="<?php echo FRONT_ROOT ?>Home/login">Iniciar Sesion</a>
                </nav>
            </div>
        </header>

        <main>
            <div class="mini-contenedor">
                    <h2>Registrarse</h2>

                    <form action="<?php echo FRONT_ROOT ?>User/addNewUser" method="post">

                        <div class="txt-field">
                            <input type="text" name="name" value="" required autocomplete="off">
                            <span></span>
                            <label for="">Nombre</label>
                        </div>
                        <div class="txt-field">
                            <input type="text" name="lastname" value="" required autocomplete="off">
                            <span></span>
                            <label for="">Apellido</label>
                        </div>
                        <div class="txt-field">
                            <input type="email" name="email" value="" required autocomplete="off">
                            <span></span>
                            <label for="">Email</label>
                        </div>
                        <div class="txt-field">
                            <input type="password" name="password" value="" required autocomplete="off">
                            <span></span>
                            <label for="">Contraseña</label>
                        </div>
                        <div class="txt-field">
                            <input type="date" name="birthdate" value="" required>
                            <span></span>
                            <label for="">Fecha de Nacimiento</label>
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