<?php 
    
    namespace Config;

    define("ROOT", dirname(__DIR__) . "/");
    //Path to your project's root folder
    define("FRONT_ROOT", "/mp/");
    define("VIEWS_PATH", "Views/");
    define("CLIENT_VIEWS", VIEWS_PATH . "Client/");
    define("ADMIN_VIEWS", VIEWS_PATH . "Admin/");
    define("CSS_PATH", FRONT_ROOT.VIEWS_PATH . "css/");
    define("JS_PATH", FRONT_ROOT.VIEWS_PATH . "js/");

    define("API_KEY", ""); //API KEY from TMDB

    define("EMAIL_USERNAME", ""); //Email used for the mailer to send the tickets
    define("EMAIL_PASSWORD", ""); //Email password

    define("DB_HOST", "localhost");
    define("DB_NAME", "mp");
    define("DB_USER", "root");
    define("DB_PASS", "");

    define("ACCESS_TOKEN", "TEST-") //Acces token for mercadopago
?>
