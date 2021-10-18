<?php

    namespace Controllers;

    use Models\Theater as Theater;
    use DAO\TheaterDAO as TheaterDAO;

    use Models\Movie as Movie;
    use DAO\MovieDAO as MovieDAO;

    use Models\Projection as Projection;
    use DAO\ProjectionDAO as ProjectionDAO;

    class TheaterController
    {
        private $theaterDAO;
        private $projectionDAO;
        private $movieDAO;

        public function __construct() 
        {
            $this->theaterDAO = new TheaterDAO();
            $this->projectionDAO = new ProjectionDAO();
            $this->MovieDAO = new MovieDAO();
        }

        public function admin()
        {
            if(isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"]->getRole() == 1)
            {
                require_once(ADMIN_VIEWS . "theaterAdmin.php");
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
                require_once(ADMIN_VIEWS . "theaterAdd.php");
            }
            else
            {
                $this->Index();
            }
        }

        private function add(Theater $theater) 
        {
            $this->theaterDAO->add($theater);
        }
        
        public function addNew($name, $address, $openingTime, $closingTime) 
        {
            if(isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"]->getRole() == 1)
            {
                if(trim($name) && trim($address)) 
                {
                    $theater = new Theater();
                    $theater->setName($name);
                    $theater->setAddress($address);
                    $theater->setOpeningTime($openingTime);
                    $theater->setClosingTime($closingTime);
                    
                    $this->add($theater);
                    echo "<script> if(confirm('Cine agregado correctamente.')); </script>";

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
                $theaterList = $this->theaterDAO->getAll();
                if($theaterList)
                {
                    require_once(ADMIN_VIEWS . "theaterList.php");
                }
                else
                {
                    echo "<script> if(confirm('No hay cines para mostrar.')); </script>";
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
                if($this->theaterDAO->getTheater($id))
                {
                    $this->theaterDAO->delete($id);

                    echo "<script> if(confirm('Cine borrado cor éxito.')); </script>";

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
                $theater = $this->theaterDAO->getTheater($id);

                if($theater)
                {
                    require_once(ADMIN_VIEWS . "theaterModify.php");
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

        public function modify($id, $name, $address, $openingTime, $closingTime)
        {
            if(isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"]->getRole() == 1)
            {
                if(trim($name) && trim($address)) 
                {
                    $theater = new Theater();
                    $theater->setId($id);
                    $theater->setName($name);
                    $theater->setAddress($address);
                    $theater->setOpeningTime($openingTime);
                    $theater->setClosingTime($closingTime);
                    
                    $this->theaterDAO->modify($theater);
                    echo "<script> if(confirm('Cine modificado correctamante.')); </script>";
                    
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
