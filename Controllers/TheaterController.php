<?php
    namespace Controllers;

    use Models\Theater as Theater;
    use DAO\TheaterDAO as TheaterDAO;

    class TheaterController
    {
        private $theaterDAO;

        public function __construct() 
        {
            $this->theaterDAO = new TheaterDAO();
        }

        public function administrar()
        {
            require_once(ADMIN_VIEWS . "admCines.php");
        }

        public function addView() {
            require_once(ADMIN_VIEWS . "agregarCine.php");
        }

        public function add(Theater $theater) {
            $this->theaterDAO->add($theater);
        }
        
        public function addNew($name, $address, $openingTime, $closingTime) {
            if(trim($name) && trim($address)) {

                $theater = new Theater($name, $address, $openingTime, $closingTime);
                
                $this->theaterDAO->add($theater);
                echo '<script language="javascript">alert("Cine agregado correctamente");</script>'; 

                $this->addView();
            }
            else {
                
                echo '<script language="javascript">alert("No puede haber campos en blanco");</script>'; 
                $this->addView();
            } 
        }

        public function modify($id, Theater $theater) {
            $this->theaterDAO->modify($id, $theater);  
        }

        public function modifyTheater($id, $name, $address, $openingTime, $closingTime) {
            
            if(trim($name) && trim($address)) {

                $newTheater = new Theater($id, $name, $address, $openingTime, $closingTime);
                
                $this->theaterDAO->modify($newTheater->getId(), $newTheater);
                echo '<script language="javascript">alert("Cine modificado correctamente");</script>'; 
                
                $this->listView();
            }
            else {
                echo '<script language="javascript">alert("No puede haber campos en blanco");</script>'; 
                require_once(ADMIN_VIEWS . "viewAdmin.php");
            }
        }
    }
?>