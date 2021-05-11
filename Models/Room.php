<?php

    namespace Models;

    class Room {

        private $id;
        private $theaterId;
        private $name;
        private $capacity;
        private $ticketValue;

        public function __construct() {
            $params = func_get_args();
            $num_params = func_num_args();
            $funcion_constructor ='__construct'.$num_params;
            
            if (method_exists($this,$funcion_constructor)) {
                call_user_func_array(array($this,$funcion_constructor),$params);
            }
	    }

        public function __construct0() {
            $this->id = "";
            $this->theaterId = "";
            $this->name = "";
            $this->capacity = "";
            $this->ticketValue = "";
        }

        public function __construct4($theaterId, $name, $capacity, $ticketValue) {
            $this->id = "";
            $this->theaterId = $theaterId;
            $this->name = $name;
            $this->capacity = $capacity;
            $this->ticketValue = $ticketValue;
        }

        public function __construct5($id, $theaterId, $name, $capacity, $ticketValue) {
            $this->id = $id;
            $this->theaterId = $theaterId;
            $this->name = $name;
            $this->capacity = $capacity;
            $this->ticketValue = $ticketValue;
        }

        public function getId() {
            return $this->id;
        }

        public function setId($value) {
            $this->id = $value;
        }

        public function getTheaterId() {
            return $this->theaterId;
        }

        public function setTheaterId($value) {
            $this->theaterId = $value;
        }

        public function getName() {
            return $this->name;
        }

        public function setName($value) {
            $this->name = $value;
        }

        public function getCapacity() {
            return $this->capacity;
        }

        public function setCapacity($value) {
            $this->capacity = $value;
        }

        public function getTicketValue() {
            return $this->ticketValue;
        }

        public function setTicketValue($value) {
            $this->ticketValue = $value;
        }
    }

?>