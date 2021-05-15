<?php
    namespace Controllers;

    use DAO\MovieGenreDAO as MovieGenreDAO;
    use Models\MovieGenre as MovieGenre;

    use DAO\ProjectionDAO as ProjectionDAO;
    use Models\Projection as Projection;

    use DAO\RoomDAO as RoomDAO;
    use Models\Room as Room;
    
    use DAO\TheaterDAO as TheaterDAO;
    use Models\Theater as Theater;

    use API\MovieAPI as MovieAPI;
    use Models\Movie as Movie;

    class MovieController
    {
        private $movieAPI;
        private $movieGenreDAO;
        private $projectionDAO;
        private $roomDAO;
        private $theaterDAO;

        public function __construct() {
            $this->movieAPI = new MovieAPI();
            $this->movieGenreDAO = new MovieGenreDAO();
            $this->projectionDAO = new ProjectionDAO();
            $this->roomDAO = new RoomDAO();
            $this->theaterDAO = new TheaterDAO();
        }

        public function getMovie($id) 
        {
            $date = getdate();
            $newDate = $date["year"] . "-" . $date["mon"] . "-" . $date["mday"];

            $projectionList = $this->projectionDAO->getFromDateAndMovie($newDate, $id);

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