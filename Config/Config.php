<?php namespace Config;

define("ROOT", dirname(__DIR__) . "/");
//Path to your project's root folder
define("FRONT_ROOT", "/MoviePass/");
define("VIEWS_PATH", "Views/");

define("CLIENT_VIEWS", VIEWS_PATH . "Client/");
define("ADMIN_VIEWS", VIEWS_PATH . "Admin/");

define("CSS_PATH", FRONT_ROOT.VIEWS_PATH . "css/");
define("JS_PATH", FRONT_ROOT.VIEWS_PATH . "js/");
define("IMG_PATH", FRONT_ROOT.VIEWS_PATH . "img/");

define("DB_HOST", "localhost");
define("DB_NAME", "MoviePass");
define("DB_USER", "root");
define("DB_PASS", "");

define("API_KEY", ""); //API KEY from TMDB
define("ACCESS_TOKEN", ""); //Acces token for MercadoPago

define("EMAIL_USERNAME", ""); //Email used for the mailer to send the tickets
define("EMAIL_PASSWORD", ""); //Email password
?>