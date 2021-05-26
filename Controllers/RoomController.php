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

        //ADD FUNCTIONS

        public function addView() {
            $theaterList = $this->theaterDAO->getAll();
            require_once(ADMIN_VIEWS . "agregarSala.php");
        }

        public function add(Room $room) {
            $this->roomDAO->add($room);
        }
        
        public function addNew($name, $capacity, $ticketValue, $theater) {
            if(trim($name)) {

                $room = new Room($theater, $name, $capacity, $ticketValue);
                
                $this->add($room);
                echo '<script language="javascript">alert("Sala agregada correctamente");</script>'; 
                
                $this->administrar();
            }
            else {
                echo '<script language="javascript">alert("No puede haber campos en blanco");</script>';
                $this->addView();
            }
        }

        //MODIFY FUNCTIONS

        public function selectView() 
        {
            $roomList = $this->roomDAO->getAll();

            if($roomList) 
            {
                require_once(ADMIN_VIEWS . "seleccionSala.php");
            }
            else
            {
                echo '<script language="javascript">alert("No hay ninguna sala disponible para mostrar.");</script>'; 
                $this->administrar();
            }
        }

        public function modifyView($room_id)
        {
            $room = $this->roomDAO->getRoom($room_id);

            require_once(ADMIN_VIEWS . "editarSala.php");
        }

        public function modify($id, $theaterId, $name, $capacity, $ticketValue) {
            
            if(trim($name)) {

                $newRoom = new Room($id, $theaterId, $name, $capacity, $ticketValue);
                
                $this->roomDAO->modify($id, $newRoom);
                echo '<script language="javascript">alert("Sala modificada correctamente");</script>'; 
                
                $this->administrar();
            }
            else {
                echo '<script language="javascript">alert("No puede haber campos en blanco");</script>'; 
                $this->modifyView($id);
            }
        }

        //DELETE FUNCTIONS

        public function deleteView() 
        {
            $roomList = $this->roomDAO->getAll();

            if($roomList) 
            {
                require_once(ADMIN_VIEWS . "borrarSala.php");
            }
            else
            {
                echo '<script language="javascript">alert("No hay ninguna sala disponible para mostrar.");</script>'; 
                $this->administrar();
            }
        }
     
        public function delete($id)
        {
            $this->roomDAO->delete($id);

            echo '<script language="javascript">alert("Sala borrada cor éxito");</script>'; 

            $this->administrar();            
        }
    }
?>