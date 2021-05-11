<?php
    namespace Controllers;

    use Models\Projection as Projection;
    use DAO\ProjectionDAO as ProjectionDAO;
    
    use DAO\RoomDAO as RoomDAO;
    
    use API\MovieAPI as MovieAPI;

    class ProjectionController
    {
        private $projectionDAO;
        private $roomDAO;
        private $movieAPI;

        public function __construct() 
        {
            $this->projectionDAO = new ProjectionDAO();
            $this->roomDAO = new RoomDAO();
            $this->movieAPI = new MovieAPI();
        }

        public function administrar()
        {
            require_once(ADMIN_VIEWS . "admFunciones.php");
        }

        public function addView() {
            $roomList = $this->roomDAO->getAll();
            $movieList = $this->movieAPI->getAllTitles();
            require_once(ADMIN_VIEWS . "agregarFuncion.php");
        }

        public function add(Projection $projection) {
            $this->projectionDAO->add($projection);
        }
        
        public function addNew($room_name, $movie_name, $_projection_date, $beginningTime) {
            $room = $this->roomDAO->getByName($room_name);
            $movie = $this->movieAPI->getByName($movie_name); 

            $projection_date = date("Y-m-d", strtotime($_projection_date));

            $date = date("Y-m-d", time());
            $time = date("H:i", time());

            /* 
                Una película solo puede ser proyectada en un único cine por día 
                Pero no puede ser reproducida en más de una sala del cine.
                Validar que el comienzo de una función sea 15 minutos después de la anterior. 
            */

            if($projection_date > $date) {
                
                $projectionList1 = $this->projectionDAO->getByDate($projection_date);
                $projectionList2 = $this->projectionDAO->getByDateAndRoom($projection_date, $room->getId());

                if($this->validateTime($projectionList2, $beginningTime) && $this->validateMovie($projectionList1, $room, $movie)) {
                    
                    $movieRuntime = date("H:i", $movie->getRuntime()*60);

                    $endingTime = date("H:i", strtotime($beginningTime) + strtotime($movieRuntime));

                    $projection = new Projection($room->getId(), $movie->getId(), $projection_date, $beginningTime, $endingTime, $room->getCapacity());
            
                    $this->add($projection);
                    echo '<script language="javascript">alert("Función agregada correctamente");</script>'; 

                    $this->addView();
                }
                else {
                    echo '<script language="javascript">alert("Error en la creacrion de la función. Por favor, revise los datos e intente nuevamente.");</script>'; 
                    $this->addView();
                }


            }
            else {
                echo '<script language="javascript">alert("La función debe ser en una fecha futura.");</script>'; 
                $this->addView();
            }
        }



        public function validateTime($projectionList, $hour) {

            if($projectionList) {
                foreach ($projectionList as $projection) {
                    $beginningTime = date("H:i", strtotime($projection->getBeginningTime()));
                    $endingTime = date("H:i", strtotime($projection->getEndingTime()) + 900);

                
                    if($hour >= $beginningTime && $hour <= $endingTime) {
                        return false;
                    }
                }
            }

            return true;
        }

        public function validateMovie($projectionList, $room, $movie) {

            if($projectionList) {
                foreach($projectionList as $projection) {

                    if($projection->getMovie() == $movie->getId()) {
                        $projectionRoom = $this->roomDAO->getRoom($projection->getRoom());

                        if($projectionRoom->getTheaterId() == $room->getTheaterId()) {
                            if($projectionRoom == $room) {
                                return true;
                            }
                            else {
                                return false;
                            }
                        }
                        else {
                            return false;
                        }

                    }
                    else {
                        return true;
                    }
                }
            }
            return true;
        }
    }
?>