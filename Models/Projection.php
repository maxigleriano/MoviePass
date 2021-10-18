<?php

    namespace Models;

    class Projection 
    {
        private $id;
        private $roomId;
        private $movieId;
        private $date;
        private $beginningTime;
        private $endingTime;
        private $availableSeats;
        private $soldSeats;

        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of roomId
         */ 
        public function getRoomId()
        {
                return $this->roomId;
        }

        /**
         * Set the value of roomId
         *
         * @return  self
         */ 
        public function setRoomId($roomId)
        {
                $this->roomId = $roomId;

                return $this;
        }

        /**
         * Get the value of movieId
         */ 
        public function getMovieId()
        {
                return $this->movieId;
        }

        /**
         * Set the value of movieId
         *
         * @return  self
         */ 
        public function setMovieId($movieId)
        {
                $this->movieId = $movieId;

                return $this;
        }

        /**
         * Get the value of date
         */ 
        public function getDate()
        {
                return $this->date;
        }

        /**
         * Set the value of date
         *
         * @return  self
         */ 
        public function setDate($date)
        {
                $this->date = $date;

                return $this;
        }

        /**
         * Get the value of beginningTime
         */ 
        public function getBeginningTime()
        {
                return $this->beginningTime;
        }

        /**
         * Set the value of beginningTime
         *
         * @return  self
         */ 
        public function setBeginningTime($beginningTime)
        {
                $this->beginningTime = $beginningTime;

                return $this;
        }

        /**
         * Get the value of endingTime
         */ 
        public function getEndingTime()
        {
                return $this->endingTime;
        }

        /**
         * Set the value of endingTime
         *
         * @return  self
         */ 
        public function setEndingTime($endingTime)
        {
                $this->endingTime = $endingTime;

                return $this;
        }

        /**
         * Get the value of availableSeats
         */ 
        public function getAvailableSeats()
        {
                return $this->availableSeats;
        }

        /**
         * Set the value of availableSeats
         *
         * @return  self
         */ 
        public function setAvailableSeats($availableSeats)
        {
                $this->availableSeats = $availableSeats;

                return $this;
        }

        /**
         * Get the value of soldSeats
         */ 
        public function getSoldSeats()
        {
                return $this->soldSeats;
        }

        /**
         * Set the value of soldSeats
         *
         * @return  self
         */ 
        public function setSoldSeats($soldSeats)
        {
                $this->soldSeats = $soldSeats;

                return $this;
        }
    }
