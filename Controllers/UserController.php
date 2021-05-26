<?php 

    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use Models\User as User;

    use DAO\ProjectionDAO as ProjectionDAO;
    use Models\Projection as Projection;

    use API\MovieAPI as MovieAPI;

    class UserController {

        private $userDAO;
        private $projectionDAO;
        private $movieAPI;

        public function __construct() {
            $this->userDAO = new UserDAO();
            $this->projectionDAO = new ProjectionDAO();
            $this->movieAPI = new MovieAPI();
        }

        public function login($email,$password) {
            $user = $this->userDAO->getUser($email,$password);

            if($user)
            {
                $_SESSION["logged_user"] = $user;

                if($_SESSION["logged_user"]->getRole() == 1)
                {   
                    $this->viewAdmin();
                }
                else
                {
                    $this->viewClient();
                }
            }
            else
            {
                echo '<script language="javascript">alert("Email o contraseña incorrecta.");</script>';
                require_once(VIEWS_PATH . "login.php");
            }
        
        }

        public function signUp() {
            require_once(VIEWS_PATH . "signUp.php");
        }

        public function logout() {   
            session_destroy();
            $movieList = $this->getMovies();
            require_once(VIEWS_PATH . "index.php");
        }

        public function viewClient() {
            $movieList = $this->getMovies();
            require_once(CLIENT_VIEWS ."viewClient.php");
        }

        public function viewAdmin() {
            $movieList = $this->getMovies();
            require_once(ADMIN_VIEWS ."viewAdmin.php");
        }
 
        public function add(User $user) {
            $this->userDAO->add($user);
        }
        
        public function addNewUser($name, $lastName, $email, $password, $birthDate) { //validar formulario
            
            if(trim($name) && trim($lastName)) {

                if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            
                    $user = new User($name, $lastName, $email, $password, $birthDate);
                    
                    if($this->userDAO->getByEmail($email)) {
                        echo '<script language="javascript">alert("El email ya está en uso");</script>';   
                        $this->signUp();  
                    }
                    else {
                        $this->userDAO->add($user);
                        echo '<script language="javascript">alert("Usuario registrado");</script>';  
                        $movieList = $this->getMovies();
                        require_once(VIEWS_PATH . "index.php");
                    }
                }
                else {
                    echo '<script language="javascript">alert("Ingrese un formato de mail válido.");</script>';   
                    $this->signUp();
                }
            }
            else {
                echo '<script language="javascript">alert("No puede haber campos en blanco");</script>'; 
                $this->signUp();  
            }
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