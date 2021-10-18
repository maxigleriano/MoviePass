<?php

    namespace Models;

    class Ticket 
    {
        private $id;
        private $qr;
        private $purchaseId;

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
         * Get the value of qr
         */ 
        public function getQr()
        {
                return $this->qr;
        }

        /**
         * Set the value of qr
         *
         * @return  self
         */ 
        public function setQr($qr)
        {
                $this->qr = $qr;

                return $this;
        }

        /**
         * Get the value of purchaseId
         */ 
        public function getpurchaseId()
        {
                return $this->purchaseId;
        }

        /**
         * Set the value of purchaseId
         *
         * @return  self
         */ 
        public function setpurchaseId($purchaseId)
        {
                $this->purchaseId = $purchaseId;

                return $this;
        }
    }