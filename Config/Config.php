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

    define("API_KEY", "b5022387ca0772253c79e8261995c6c6"); //API KEY from TMDB

    define("EMAIL_USERNAME", "moviepass534@gmail.com"); //Email used for the mailer to send the tickets
    define("EMAIL_PASSWORD", "notelaolvides123"); //Email password

    define("DB_HOST", "localhost");
    define("DB_NAME", "mp");
    define("DB_USER", "root");
    define("DB_PASS", "root");

    define("ACCESS_TOKEN", "TEST-2384151919511684-111814-00865ad6efdb6877feb4761175038a0f-372140809")
?>
