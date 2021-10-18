<?php

    namespace Models;

    class Room 
    {
        private $id;
        private $theaterId;
        private $name;
        private $capacity;
        private $ticketValue;

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
         * Get the value of theaterId
         */ 
        public function getTheaterId()
        {
                return $this->theaterId;
        }

        /**
         * Set the value of theaterId
         *
         * @return  self
         */ 
        public function setTheaterId($theaterId)
        {
                $this->theaterId = $theaterId;

                return $this;
        }

        /**
         * Get the value of name
         */ 
        public function getName()
        {
                return $this->name;
        }

        /**
         * Set the value of name
         *
         * @return  self
         */ 
        public function setName($name)
        {
                $this->name = $name;

                return $this;
        }

        /**
         * Get the value of capacity
         */ 
        public function getCapacity()
        {
                return $this->capacity;
        }

        /**
         * Set the value of capacity
         *
         * @return  self
         */ 
        public function setCapacity($capacity)
        {
                $this->capacity = $capacity;

                return $this;
        }

        /**
         * Get the value of ticketValue
         */ 
        public function getTicketValue()
        {
                return $this->ticketValue;
        }

        /**
         * Set the value of ticketValue
         *
         * @return  self
         */ 
        public function setTicketValue($ticketValue)
        {
                $this->ticketValue = $ticketValue;

                return $this;
        }
    }
