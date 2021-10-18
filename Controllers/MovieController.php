<?php

    namespace Controllers;

    use Models\Movie as Movie;
    use DAO\MovieDAO as MovieDAO;

    use Models\Projection as Projection;
    use DAO\ProjectionDAO as ProjectionDAO;

    use DAO\RoomDAO as RoomDAO;
    use Models\Room as Room;
    
    use DAO\TheaterDAO as TheaterDAO;
    use Models\Theater as Theater;
    
    class MovieController
    {
        private $movieDAO;
        private $projectionDAO;
        private $roomDAO;
        private $theaterDAO;

        public function __construct() {
            $this->movieDAO = new MovieDAO();
            $this->projectionDAO = new ProjectionDAO();
            $this->roomDAO = new RoomDAO();
            $this->theaterDAO = new TheaterDAO();
        }

        public function getMovie($movieId)
        {
            $movie = $this->movieDAO->getMovie($movieId);
            $trailer = $this->movieDAO->getTrailer($movieId);

            $projectionList = $this->getProjections($movieId);


            if($movie) 
            {
               require_once(VIEWS_PATH . "movieDetails.php");
            }
            else
            {
                echo "<script> if(confirm('.')); </script>";
                $this->Index();
            }
        }

        public function getProjections($movieId)
        {
            $date = getdate();
            $todayDate = $date["year"] . "-" . $date["mon"] . "-" . $date["mday"];

            $projections = $this->projectionDAO->getAll();

            $projectionsReturn = null;

            if($projections)
            {
                $projectionsReturn = array();
                foreach($projections as $projection) 
                {
                    if($projection->getDate() >= $todayDate && $projection->getMovieId() == $movieId)
                    {
                        array_push($projectionsReturn, $projection);
                    }
                }
            }

            return $projectionsReturn;
        }

        //INDEX FUNCTIONS

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
