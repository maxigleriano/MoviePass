<?php

    namespace Controllers;

    use Models\Projection as Projection;
    use DAO\ProjectionDAO as ProjectionDAO;

    use Models\Room as Room;
    use DAO\RoomDAO as RoomDAO;

    use Models\Theater as Theater;
    use DAO\TheaterDAO as TheaterDAO;

    use Models\Movie as Movie;
    use DAO\MovieDAO as MovieDAO;

    class ProjectionController
    {
        private $projectionDAO;
        private $roomDAO;
        private $theaterDAO;
        private $movieDAO;

        public function __construct() 
        {
            $this->projectionDAO = new ProjectionDAO();
            $this->roomDAO = new RoomDAO();
            $this->theaterDAO = new TheaterDAO();
            $this->movieDAO = new MovieDAO();
        }

        public function admin()
        {
            if(isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"]->getRole() == 1)
            {
                require_once(ADMIN_VIEWS . "projectionAdmin.php");
            }
            else
            {
                $this->Index();
            }
        }

        public function addView() 
        {
            if(isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"]->getRole() == 1)
            {
                $roomList = $this->roomDAO->getAll();
                $movieList = $this->movieDAO->getAll();
                require_once(ADMIN_VIEWS . "projectionAdd.php");
            }
            else
            {
                $this->Index();
            }
        }

        private function add(Projection $projection) 
        {
            $this->projectionDAO->add($projection);
        }
        
        public function addNew($roomId, $movieId, $date, $beginningTime) 
        {
            if(isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"]->getRole() == 1)
            {
                $todayDate = date("Y-m-d", time());

                if($date > $todayDate) 
                {
                    $movie = $this->movieDAO->getMovie($movieId);
                    $room = $this->roomDAO->getRoom($roomId);

                    $validation1 = $this->theaterValidation($room, $movie, $date);
                    $validation2 = $this->timeValidation($room, $movie, $date, $beginningTime);

                    if($validation1 && $validation2)
                    {
                        $movieRuntime = $movie->getRuntime()*60;

                        $endingTime = date("H:i:s", strtotime($beginningTime) + $movieRuntime);
    
                        $projection = new Projection();
                        $projection->setRoomId($roomId);
                        $projection->setMovieId($movieId);
                        $projection->setDate($date);
                        $projection->setBeginningTime($beginningTime);
                        $projection->setEndingTime($endingTime);
                        $projection->setAvailableSeats($room->getCapacity());
                
                        $this->add($projection);

                        echo "<script> if(confirm('Función agregada correctamente.')); </script>";
    
                        $this->addView();
                    }
                    else
                    {
                        echo "<script> if(confirm('Error. Por favor revise los datos e intente nuevamente.')); </script>";
                        $this->addView();
                    }
                }
                else
                {
                    echo "<script> if(confirm('Error. La función debe ser agregada en una fecha futura.')); </script>";
                    $this->addView();
                }
            }
            else
            {
                $this->Index();
            }
            
        }

        public function list()
        {
            if(isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"]->getRole() == 1)
            {
                $projectionList = $this->projectionDAO->getAll();
                if($projectionList)
                {
                    require_once(ADMIN_VIEWS . "projectionList.php");
                }
                else
                {
                    echo "<script> if(confirm('No hay funciones para mostrar.')); </script>";
                    $this->admin();
                }
                
            }
            else
            {
                $this->Index();
            }
        }

        public function remove($id)
        {
            //  TODO 
        }

        public function modifyView($id)
        {
            //TODO
        }

        public function modify()
        {
            //TODO
        }

        /* 
            A movie can only be screened in one theater per day,
            but it cannot be played in more than one room.
            Validate that the start of a projection is 15 minutes after the previous one.
        */

        private function theaterValidation(Room $room, Movie $movie, $date)
        {
            $return = true;

            $projections = $this->projectionDAO->getByDate($date);

            if($projections)
            {
                $i = 0;
                while($i < count($projections) && $return)
                {
                    if($projections[$i]->getMovieId() == $movie->getId())
                    {
                        $loopRoom = $this->roomDAO->getRoom($projections[$i]->getRoomId());
                        if($loopRoom->getTheaterId() == $room->getTheaterId())
                        {
                            if($loopRoom->getId() != $room->getId())
                            {
                                $return = false;
                            }
                        }
                        else
                        {
                            $return = false;
                        }
                    }

                    $i++;
                }
            }

            return $return;
        }

        private function timeValidation(Room $room, Movie $movie, $date, $beginningTime)
        {
            $return = true;

            $projections = $this->projectionDAO->getByDateAndRoom($date, $room->getId());

            if($projections)
            {
                $endingTime = date("H:i:s", strtotime($beginningTime) + $movie->getRuntime()*60);

                $i = 0;
                while($i < count($projections) && $return)
                {
                    if(isset($projections[$i+1]))
                    {
                        $_endingTime = date("H:i:s", strtotime($projections[$i]->getEndingTime()) + 900);
                        $_beginningTime = date("H:i:s", strtotime($projections[$i+1]->getBeginningTime()));

                        if($_endingTime > $beginningTime || $endingTime > $beginningTime)
                        {
                            $return = false;
                        }
                    }
                    else
                    {
                        $_endingTime = date("H:i:s", strtotime($projections[$i]->getEndingTime()) + 900);

                        if($_endingTime > $beginningTime)
                        {
                            $return = false;
                        }
                    }
                    

                    $i++;
                }
            }

            return $return;
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
