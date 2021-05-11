<?php  

    namespace Models;

    class Theater {
        private $id;
        private $name;
        private $address;
        private $openingTime;
        private $closingTime;

        public function __construct() {
            
            //obtengo un array con los parámetros enviados a la función
            $params = func_get_args();
            //saco el número de parámetros que estoy recibiendo
            $num_params = func_num_args();
            //cada constructor de un número dado de parámtros tendrá un nombre de función
            //atendiendo al siguiente modelo __construct1() __construct2()...
            $funcion_constructor ='__construct'.$num_params;
            //compruebo si hay un constructor con ese número de parámetros
            if (method_exists($this,$funcion_constructor)) {
                //si existía esa función, la invoco, reenviando los parámetros que recibí en el constructor original
                call_user_func_array(array($this,$funcion_constructor),$params);
            }
	    }

        public function __construct0() {
            $this->id = "";
            $this->name = "";
            $this->address = "";
            $this->openingTime = "";
            $this->closingTime = "";
        }

        public function __construct4($name, $address, $openingTime, $closingTime) {
            $this->id = "";
            $this->name = $name;
            $this->address = $address;
            $this->openingTime = $openingTime;
            $this->closingTime = $closingTime;
        }

        public function __construct5($id, $name, $address, $openingTime, $closingTime) {
            $this->id = $id;
            $this->name = $name;
            $this->address = $address;
            $this->openingTime = $openingTime;
            $this->closingTime = $closingTime;
        }

        public function setId($value) {
            $this->id = $value;
        }

        public function getId() {
            return $this->id;
        }

        public function setName($value) {
            $this->name = $value;
        }

        public function getName() {
            return $this->name;
        }

        public function setAddress($value) {
            $this->address = $value;
        }

        public function getAddress() {
            return $this->address;
        }

        public function setOpeningTime($value) {
            $this->openingTime = $value;
        }

        public function getOpeningTime() {
            return $this->openingTime;
        }

        public function setClosingTime($value) {
            $this->closingTime = $value;
        }

        public function getClosingTime() {
            return $this->closingTime;
        }
    }


?>