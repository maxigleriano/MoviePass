<?php

    namespace Models;

    class Projection {

        private $id;
        private $room;
        private $movie;
        private $date;
        private $beginningTime;
        private $endingTime;
        private $availableSeats;
        private $soldSeats;


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
            $this->room = "";
            $this->movie = "";
            $this->date = "";
            $this->beginningTime = "";
            $this->endingTime = "";
            $this->availableSeats = "";
            $this->solSeats = "";
        }

        public function __construct5($room, $movie, $date, $beginningTime, $availableSeats) {
            $this->id = "";
            $this->room = $room;
            $this->movie = $movie;
            $this->date = $date;
            $this->beginningTime = $beginningTime;
            $this->endingTime = "";
            $this->seats = $availableSeats;
            $this->solSeats = 0;
        }
    
        public function __construct6($room, $movie, $date, $beginningTime, $endingTime, $availableSeats) {
            $this->id = "";
            $this->room = $room;
            $this->movie = $movie;
            $this->date = $date;
            $this->beginningTime = $beginningTime;
            $this->endingTime = $endingTime;
            $this->availableSeats = $availableSeats;
            $this->solSeats = 0;
        }

        public function __construct8($id, $room, $movie, $date, $beginningTime, $endingTime, $availableSeats, $soldSeats) {
            $this->id = $id;
            $this->room = $room;
            $this->movie = $movie;
            $this->date = $date;
            $this->beginningTime = $beginningTime;
            $this->endingTime = $endingTime;
            $this->availableSeats = $availableSeats;
            $this->soldSeats = $soldSeats;
        }

        public function getId() {
            return $this->id;
        }

        public function setId($value) {
            $this->id = $value;
        }

        public function getRoom() {
            return $this->room;
        }

        public function setRoom($value) {
            $this->room = $value;
        }

        public function getMovie() {
            return $this->movie;
        }

        public function setMovie($value) {
            $this->movie = $value;
        }

        public function getDate() {
            return $this->date;
        }

        public function setDate($value) {
            $this->date = $value;
        }

        public function getBeginningTime() {
            return $this->beginningTime;
        }

        public function setBeginningTime($value) {
            $this->beginningTime = $value;
        }

        public function getEndingTime() {
            return $this->endingTime;
        }

        public function setEndingTime($value) {
            $this->endingTime = $value;
        }

        public function getAvailableSeats() {
            return $this->availableSeats;
        }

        public function setAvailableSeats($value) {
            $this->availableSeats = $value;
        }

        public function getSoldSeats() {
            return $this->soldSeats;
        }

        public function setSoldSeats($value) {
            $this->soldSeats = $value;
        }
    }

?>