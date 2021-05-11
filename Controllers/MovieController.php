<?php
    namespace Controllers;

    use DAO\MovieGenreDAO as MovieGenreDAO;
    use Models\MovieGenre as MovieGenre;
    
    use API\MovieAPI as MovieAPI;
    use Models\Movie as Movie;

    class MovieController
    {
        private $movieAPI;
        private $movieGenreDAO;

        public function __construct() {
            $this->movieAPI = new MovieAPI();
            $this->movieGenreDAO = new MovieGenreDAO();
        }

        public function getMovie($id) 
        {
            $movie = $this->movieAPI->getById($id);
            $trailer = $this->movieAPI->getTrailer($id);

            if($_SESSION["logged_user"]) 
            {
                if($_SESSION["logged_user"]->getRole() == 1)
                {
                    require_once(ADMIN_VIEWS . "detallesPelicula.php");
                }
                else
                {
                    require_once(CLIENT_VIEWS . "detallesPelicula.php");
                }
            }
            else
            {
                require_once(VIEWS_PATH."detallesPelicula.php");
            }

        }
    }

?>