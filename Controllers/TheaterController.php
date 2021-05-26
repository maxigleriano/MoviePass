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

        //ADD FUNCTIONS

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
            $theaterList = $this->theaterDAO->getAll();

            if($theaterList) 
            {
                require_once(ADMIN_VIEWS . "seleccionCine.php");
            }
            else
            {
                echo '<script language="javascript">alert("No hay ningún cine disponible para mostrar.");</script>'; 
                $this->administrar();
            }
        }

        public function modifyView($theater_id)
        {
            $theater = $this->theaterDAO->getTheater($theater_id);

            require_once(ADMIN_VIEWS . "editarCine.php");
        }

        public function modify($id, $name, $address, $openingTime, $closingTime) {
            
            if(trim($name) && trim($address)) {

                $newTheater = new Theater($id, $name, $address, $openingTime, $closingTime);
                
                $this->theaterDAO->modify($newTheater->getId(), $newTheater);
                echo '<script language="javascript">alert("Cine modificado correctamente");</script>'; 
                
                $this->administrar();
            }
            else {
                echo '<script language="javascript">alert("No puede haber campos en blanco");</script>'; 
                $this->administrar();
            }
        }

        //DELETE FUNCTIONS

        public function deleteView() 
        {
            $theaterList = $this->theaterDAO->getAll();

            if($theaterList) 
            {
                require_once(ADMIN_VIEWS . "borrarCine.php");
            }
            else
            {
                echo '<script language="javascript">alert("No hay ningún cine disponible para mostrar.");</script>'; 
                $this->administrar();
            }
        }
     
        public function delete($id)
        {
            $this->theaterDAO->delete($id);

            echo '<script language="javascript">alert("Cine borrado cor éxito");</script>'; 

            $this->administrar();            
        }
    }
?>