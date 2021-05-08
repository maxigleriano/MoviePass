<?php
    namespace Controllers;

    use API\MovieAPI as MovieAPI;

    class HomeController
    {
        private $movieAPI;

        public function __construct() 
        {
            $this->movieAPI = new MovieAPI();
        }
        
        public function Index($message = "")
        {
            $movieList = $this->listAllMovies();

            require_once(VIEWS_PATH."index.php");
        }  

        public function listAllMovies() 
        {
            $movies = $this->movieAPI->getAll();
    
            return $movies;
        }

        public function cartelera() {
            $movieList = $this->listAllMovies();

            require_once(VIEWS_PATH."cartelera.php");
        }

        public function carteleraCliente() {
            $movieList = $this->listAllMovies();

            require_once(CLIENT_VIEWS."carteleraCliente.php");
        }

        public function login() 
        {
            require_once(VIEWS_PATH."login.php");
        }
    }

    
?>