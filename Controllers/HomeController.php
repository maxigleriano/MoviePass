<?php

    namespace Controllers;

    use Models\Movie as Movie;
    use DAO\MovieDAO as MovieDAO;

    use Models\Projection as Projection;
    use DAO\ProjectionDAO as ProjectionDAO;

    use Models\User as User;
    
    class HomeController
    {
        private $movieDAO;
        private $projectionDAO;

        public function __construct() {
            $this->movieDAO = new MovieDAO();
            $this->projectionDAO = new ProjectionDAO();
        }

        public function Index($message = "")
        {         
            $movieList = $this->getMovies();
            $principalMovie = null;

            if($movieList)
            {
                $principalMovie = $movieList[count($movieList)-1];

                $this->updateImg($principalMovie->getBackdropPath());
            }

            require_once(VIEWS_PATH."index.php");
        }

        public function cartelera() 
        {
            $movieList = $this->getMovies();

            if($movieList)
            {
                require_once(VIEWS_PATH . "movies.php");
            }
            else
            {
                echo '<script language="javascript">alert("No hay películas disponibles para mostrar");</script>';
                
                $this->Index();
            }  
        }

        public function admin() 
        {
            if(isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"]->getRole() == 1) 
            {
                require_once(ADMIN_VIEWS . "admin.php");
            }
            else
            {
                $this->Index();
            }
        }

        private function getMovies()
        {
            $date = getdate();
            $todayDate = $date["year"] . "-" . $date["mon"] . "-" . $date["mday"];

            $projections = $this->projectionDAO->getAll();

            $movies = null;

            if($projections)
            {
                $movies = array();
                foreach($projections as $projection) 
                {
                    if($projection->getDate() >= $todayDate)
                    {
                        $movie = $this->movieDAO->getMovie($projection->getMovieId());

                        array_push($movies, $movie);
                    }
                }

                array_unique($movies, SORT_REGULAR);
            }

            return $movies;
        }

        private function updateImg($image)
        {
            $fp=fopen("./Views/img/backdrop.jpg", "w");
            
            $ch=curl_init();
            
            curl_setopt($ch, CURLOPT_URL, $image);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FILE, $fp);
            
            curl_exec($ch);

            curl_close($ch);
            
            fclose($fp);
        }
    }
