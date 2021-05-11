<?php
    namespace Controllers;

    use Models\Room as Room;
    use DAO\RoomDAO as RoomDAO;
    
    use Models\Theater as Theater;
    use DAO\TheaterDAO as TheaterDAO;

    class RoomController
    {
        private $roomDAO;
        private $theaterDAO;

        public function __construct() 
        {
            $this->roomDAO = new RoomDAO();
            $this->theaterDAO = new TheaterDAO();
        }

        public function administrar()
        {
            require_once(ADMIN_VIEWS . "admSalas.php");
        }

        public function addView() {
            $theaterList = $this->theaterDAO->getAll();
            require_once(ADMIN_VIEWS . "agregarSala.php");
        }

        public function add(Room $room) {
            $this->roomDAO->add($room);
        }
        
        public function addNew($name, $capacity, $ticketValue, $theaterName) {
            if(trim($name)) {
            
                $theater = $this->theaterDAO->getByName($theaterName);

                $room = new Room($theater->getId(), $theater->getName() . " - ". $name, $capacity, $ticketValue);
                
                $this->add($room);
                echo '<script language="javascript">alert("Sala agregada correctamente");</script>'; 
                
                $this->addView();
            }
            else {
                echo '<script language="javascript">alert("No puede haber campos en blanco");</script>';
                $this->addView();
            }
        }
    }
?>