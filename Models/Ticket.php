<?php

    namespace Models;

    class Ticket {
        private $id;
        private $qr;
        private $purchase;

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
            $this->qr = "";
            $this->purchase = "";
        }

        public function __construct1($purchase) {
            $this->id = "";
            $this->qr = "";
            $this->purchase = $purchase;
        }

        public function __construct2($qr, $purchase) {
            $this->id = "";
            $this->qr = $qr;
            $this->purchase = $purchase;
        }

        public function __construct3($id, $qr, $purchase) {
            $this->id = $id;
            $this->qr = $qr;
            $this->purchase = $purchase;
        }

        public function getId() {
            return $this->id;
        }

        public function setId($value) {
            $this->id = $value;
        }

        public function getQr() {
            return $this->qr;
        }

        public function setQr($value) {
            $this->qr = $value;
        }

        public function getPurchase() {
            return $this->purchase;
        }

        public function setPurchase($value) {
            $this->purchase = $value;
        }
    }

?>