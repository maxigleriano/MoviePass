<?php 

    namespace Controllers;

    use Models\User as User;
    use DAO\UserDAO as UserDAO;

    use Models\Projection as Projection;
    use DAO\ProjectionDAO as ProjectionDAO;

    use Models\Movie as Movie;
    use DAO\MovieDAO as MovieDAO;

    class UserController
    {
        private $userDAO;
        private $projectionDAO;
        private $movieDAO;

        public function __construct() 
        {
            $this->userDAO = new UserDAO();
            $this->projectionDAO = new ProjectionDAO();
            $this->movieDAO = new MovieDAO();
        }

        public function loginView() 
        {
            require_once(VIEWS_PATH."login.php");
        }

        public function login($email,$password) 
        {
            try
            {
                $user = $this->userDAO->getUser($email);
            }
            catch(PDOException $e)
            {
                echo "<script> if(confirm('Se ha producido un error. Por favor vuelva a intentarlo')); </script>";
                $this->loginView();
            }
            

            if($user)
            {
                if($user->getEmail() == $email && password_verify($password, $user->getPassword()))
                {
                    $_SESSION["loggedUser"] = $user;
                    $this->Index();
                }
                else
                {
                    echo "<script> if(confirm('Email y/o contraseña incorrectos. Por favor vuelva a intentarlo')); </script>";
                    $this->loginView();
                }
            }
            else
            {
                echo "<script> if(confirm('Email y/o contraseña incorrectos. Por favor vuelva a intentarlo')); </script>";
                $this->loginView();
            }
        
        }

        public function signup() 
        {
            require_once(VIEWS_PATH . "signup.php");
        }

        private function add(User $user) 
        {
            $this->userDAO->add($user);
        }

        public function addNewUser($name, $lastName, $email, $password, $birthDate) //validar formulario
        { 
            if(trim($name) && trim($lastName))
            {
                if(filter_var($email, FILTER_VALIDATE_EMAIL)) 
                {
                    if($this->userDAO->getUser($email)) 
                    {
                        echo "<script> if(confirm('El email ya está en uso. Por favor vuelva a intentarlo')); </script>";  
                        $this->signup();
                    }
                    else 
                    {
                        $user = new User();
                        $user->setName($name);
                        $user->setLastName($lastName);
                        $user->setEmail($email);
                        $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
                        $user->setBirthDate($birthDate);
                        $user->setRole(2);
                        
                        try
                        {
                            $this->add($user);
                        }
                        catch(PDOException $e)
                        {
                            echo "<script> if(confirm('Se ha producido un error. Por favor vuelva a intentarlo')); </script>";
                            $this->signup();
                        }
                        
                        echo "<script> if(confirm('Usuario registrado')); </script>";
                        
                        $this->Index();
                    }
                }
                else 
                {
                    echo "<script> if(confirm('Ingrese un formato de mail válido.')); </script>"; 
                    $this->signup();
                }
            }
            else 
            {
                echo '<script language="javascript">alert("No puede haber campos en blanco");</script>'; 
                $this->signup();  
            }
        }

        public function logout() 
        {   
            unset($_SESSION["loggedUser"]);

            $this->Index();
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
