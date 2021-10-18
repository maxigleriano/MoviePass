<?php  

    namespace Models;

    class Theater 
    {
        private $id;
        private $name;
        private $address;
        private $openingTime;
        private $closingTime;

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
         * Get the value of address
         */ 
        public function getAddress()
        {
                return $this->address;
        }

        /**
         * Set the value of address
         *
         * @return  self
         */ 
        public function setAddress($address)
        {
                $this->address = $address;

                return $this;
        }

        /**
         * Get the value of openingTime
         */ 
        public function getOpeningTime()
        {
                return $this->openingTime;
        }

        /**
         * Set the value of openingTime
         *
         * @return  self
         */ 
        public function setOpeningTime($openingTime)
        {
                $this->openingTime = $openingTime;

                return $this;
        }

        /**
         * Get the value of closingTime
         */ 
        public function getClosingTime()
        {
                return $this->closingTime;
        }

        /**
         * Set the value of closingTime
         *
         * @return  self
         */ 
        public function setClosingTime($closingTime)
        {
                $this->closingTime = $closingTime;

                return $this;
        }
    }
