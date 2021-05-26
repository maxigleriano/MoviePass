<?php

    namespace Models;

    class Purchase {
         private $id;
         private $tickets;
         private $total;
         private $date;
         private $user;
         private $projection;

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
            $this->tickets = "";
            $this->total = "";
            $this->date = "";
            $this->user = "";
            $this->projection = "";
        }

        public function __construct5($tickets, $total, $date, $user, $projection) {
            $this->id = "";
            $this->tickets = $tickets;
            $this->total = $total;
            $this->date = $date;
            $this->user = $user;
            $this->projection = $projection;

        }

        public function __construct6($id, $tickets, $total, $date, $user, $projection) {
            $this->id = $id;
            $this->tickets = $tickets;
            $this->total = $total;
            $this->date = $date;
            $this->user = $user;
            $this->projection = $projection;

        }

        public function setId($value) {
            $this->id = $value;
        }

        public function getId() {
            return $this->id;
        }

        public function setTickets($value) {
            $this->tickets = $value;
        }

        public function getTickets() {
            return $this->tickets;
        }

        public function setTotal($value) {
            $this->total = $value;
        }

        public function getTotal() {
            return $this->total;
        }

        public function setDate($value) {
            $this->date = $value;
        }

        public function getDate() {
            return $this->date;
        }

        public function setUser($value) {
            $this->user = $value;
        }

        public function getUser() {
            return $this->user;
        }

        public function setProjection($value) {
            $this->projection = $value;
        }

        public function getProjection() {
            return $this->projection;
        }
        

    }

?>