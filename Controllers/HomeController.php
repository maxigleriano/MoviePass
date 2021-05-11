<?php
    namespace Controllers;

    use DAO\ProjectionDAO as ProjectionDAO;

    use API\MovieAPI as MovieAPI;

    use Models\User as User;
    use Models\Projection as Projection;

    class HomeController
    {
        private $movieAPI;
        private $projectionDAO;

        public function __construct() 
        {
            $this->movieAPI = new MovieAPI();
            $this->projectionDAO = new ProjectionDAO();
        }
        
        public function Index($message = "")
        {
            $movieList = $this->getMovies();

            if($_SESSION["logged_user"])
            {
                if($_SESSION["logged_user"]->getRole() == 1)
                {
                    require_once(ADMIN_VIEWS . "viewAdmin.php");
                }
                else
                {
                    require_once(CLIENT_VIEWS . "viewClient.php");
                }
            }
            else
            {
                require_once(VIEWS_PATH."index.php");
            }  
        }  

        public function cartelera() 
        {
            $movieList = $this->getMovies();

            if($movieList)
            {
                if($_SESSION["logged_user"]) 
                {
                    if($_SESSION["logged_user"]->getRole() == 1)
                    {
                        require_once(ADMIN_VIEWS . "CarteleraAdmin.php");
                    }
                    else
                    {
                        require_once(CLIENT_VIEWS . "carteleraCliente.php");
                    }
                }
                else
                {
                    require_once(VIEWS_PATH."cartelera.php");
                }
            }
            else
            {
                echo '<script language="javascript">alert("No hay películas disponibles para mostrar");</script>'; 
            }

            
        }

        public function administrar() 
        {
            if($_SESSION["logged_user"]) 
            {
                if($_SESSION["logged_user"]->getRole() == 1)
                {
                    require_once(ADMIN_VIEWS . "administrar.php");
                }
                else
                {
                    $this->Index();
                }
            }
            else
            {
                $this->Index();
            }
        }

        public function login() 
        {
            require_once(VIEWS_PATH."login.php");
        }

        public function listAllMovies() 
        {
            $movies = $this->movieAPI->getAll();
    
            return $movies;
        }

        public function getMovies() {
            $date = getdate();
            $newDate = $date["year"] . "-" . $date["mon"] . "-" . $date["mday"];
            
            $projections = $this->projectionDAO->getFrom($newDate);

            if($projections) {

                $movieIds = array();
                foreach($projections as $projection) {
                    array_push($movieIds, $projection->getMovie());
                }

                $movieList = $this->movieAPI->getMovies(array_unique($movieIds));
                
                if($movieList) {
                    return $movieList;
                }
                else {
                    return null;
                }
            }
            else {
                return null;
            }
        }
    }
 
?>