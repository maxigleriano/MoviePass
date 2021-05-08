<?php

    namespace Models;

    class User {
        private $id;
        private $name;
        private $lastName;
        private $email;
        private $password;
        private $birthDate;
        private $role;

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
            $this->role = 2;
            $this->id = "";
            $this->name = "";
            $this->lastName = "";
            $this->email = "";
            $this->password = "";
            $this->birthDate = "";
        }

        public function __construct5($name, $lastName, $email, $password, $birthDate) {
            $this->role = 2;
            $this->id = ' ';
            $this->name = $name;
            $this->lastName = $lastName;
            $this->email = $email;
            $this->password = $password;
            $this->birthDate = $birthDate;
        }

        public function __construct6($id, $name, $lastName, $email, $password, $birthDate) {
            $this->role = 2;
            $this->id = $id;
            $this->name = $name;
            $this->lastName = $lastName;
            $this->email = $email;
            $this->password = $password;
            $this->birthDate = $birthDate;
        }

        public function __construct7($role, $id, $name, $lastName, $email, $password, $birthDate) {
            $this->role = $role;
            $this->id = $id;
            $this->name = $name;
            $this->lastName = $lastName;
            $this->email = $email;
            $this->password = $password;
            $this->birthDate = $birthDate;
        }
        

        public function getId() {
            return $this->id;
        }

        public function setId($value) {
            $this->id = $value;
        }

        public function getName() {
            return $this->name;
        }

        public function setName($value) {
            $this->name = $value;
        }

        public function getLastName() {
            return $this->lastName;
        }

        public function setLastName($value) {
            $this->lastName = $value;
        }

        public function getEmail() {
            return $this->email;
        }

        public function setEmail($value) {
            $this->email = $value;
        }

        public function getPassword() {
            return $this->password;
        }

        public function setPassword($value) {
            $this->password = $value;
        }

        public function getBirthDate() {
            return $this->birthDate;
        }

        public function setBirthDate($value) {
            $this->birthDate = $value;
        }

        public function getRole() {
            return $this->role;
        }

        public function setRole($value) {
            $this->role = $value;
        }

        
    }

?>