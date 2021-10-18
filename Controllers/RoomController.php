<?php

    namespace Controllers;

    use Models\Room as Room;
    use DAO\RoomDAO as RoomDAO;

    use Models\Theater as Theater;
    use DAO\TheaterDAO as TheaterDAO;

    use Models\Movie as Movie;
    use DAO\MovieDAO as MovieDAO;

    use Models\Projection as Projection;
    use DAO\ProjectionDAO as ProjectionDAO;

    class RoomController
    {
        private $roomDAO;
        private $theaterDAO;
        private $projectionDAO;
        private $movieDAO;

        public function __construct() 
        {
            $this->roomDAO = new RoomDAO();
            $this->theaterDAO = new TheaterDAO();
            $this->projectionDAO = new ProjectionDAO();
            $this->movieDAO = new MovieDAO();
        }

        public function admin()
        {
            if(isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"]->getRole() == 1)
            {
                require_once(ADMIN_VIEWS . "roomAdmin.php");
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
                $theaterList = $this->theaterDAO->getAll();
                require_once(ADMIN_VIEWS . "roomAdd.php");
            }
            else
            {
                $this->Index();
            }
        }

        private function add(Room $room) 
        {
            $this->roomDAO->add($room);
        }
        
        public function addNew($name, $capacity, $ticketValue, $theaterId) 
        {
            if(isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"]->getRole() == 1)
            {
                if(trim($name)) 
                {
                    $room = new Room();
                    $room->setName($name);
                    $room->setCapacity($capacity);
                    $room->setTicketvalue($ticketValue);
                    $room->setTheaterId($theaterId);
                    
                    $this->add($room);
                    echo "<script> if(confirm('Sala agregado correctamente.')); </script>";

                    $this->admin();
                }
                else 
                {
                    echo "<script> if(confirm('No puede haber campos en blanco.')); </script>";
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
                $roomList = $this->roomDAO->getAll();
                if($roomList)
                {
                    require_once(ADMIN_VIEWS . "roomList.php");
                }
                else
                {
                    echo "<script> if(confirm('No hay salas para mostrar.')); </script>";
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
            if(isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"]->getRole() == 1)
            {
                if($this->roomDAO->getRoom($id))
                {
                    $this->roomDAO->delete($id);

                    echo "<script> if(confirm('Sala borrado cor éxito.')); </script>";

                    $this->admin(); 
                }
                else
                {
                    echo "<script> if(confirm('Error. Vuelva a intentarlo.')); </script>";
                    $this->admin(); 
                }
                   
            }
            else
            {
                $this->Index();
            }
            
        }

        public function modifyView($id)
        {
            if(isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"]->getRole() == 1)
            {
                $room = $this->roomDAO->getRoom($id);

                if($room)
                {
                    require_once(ADMIN_VIEWS . "roomModify.php");
                }
                else
                {
                    echo "<script> if(confirm('Error. Vuelva a intentarlo.')); </script>";
                    $this->admin(); 
                }
            }
            else
            {
                $this->Index();
            }
        }

        public function modify($id, $theaterId, $name, $capacity, $ticketValue)
        {
            if(isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"]->getRole() == 1)
            {
                if(trim($name)) 
                {
                    $room = new Room();
                    $room->setId($id);
                    $room->setTheaterId($theaterId);
                    $room->setName($name);
                    $room->setCapacity($capacity);
                    $room->setTicketValue($ticketValue);
                    
                    $this->roomDAO->modify($room);
                    echo "<script> if(confirm('Sala modificado correctamante.')); </script>";
                    
                    $this->admin();
                }
                else 
                {
                    echo "<script> if(confirm('No puede haber campos en blanco.')); </script>";
                    $this->admin();
                }
            }
            else
            {
                $this->Index();
            }
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
