<?php 

    namespace DAO;

    use Models\User as User;
    use DAO\Connection as Connection;

    class UserDAO 
    {
        private $connection;
        private $tableName = "users";

        public function add(User $user) {
            try {
                $query = "INSERT INTO " . $this->tableName . " (user_role, user_name, user_last_name, email, user_password, birth_date) VALUES (:user_role, :user_name, :user_last_name, :email, :user_password, :birth_date);";

                $parameters["user_role"] = $user->getRole();
                $parameters["user_name"] = $user->getName();
                $parameters["user_last_name"] = $user->getLastName();
                $parameters["email"] = $user->getEmail();
                $parameters["user_password"] = $user->getPassword();
                $parameters["birth_date"] = $user->getBirthDate();

                $this->connection = Connection::GetInstance();
                
                $this->connection->ExecuteNonQuery($query,$parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function modify($id, User $user) {
            try
            {
                $query = "UPDATE " . $this->tableName . " SET user_name = :user_name, user_last_name = :user_last_name, email = :email, user_password = :user_password, birth_date = :birth_date WHERE (user_id = :user_id);";

                $this->connection = Connection::GetInstance();

                $parameters["user_id"] = $id;
                $parameters["user_name"] = $user->getName();
                $parameters["user_last_name"] = $user->getLastName();
                $parameters["email"] = $user->getEmail();
                $parameters["user_password"] = $user->getPassword();
                $parameters["birth_date"] = $user->getBirthDate();

                $this->connection->ExecuteNonQuery($query,$parameters);

            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        public function getUser($email) {
            try {
                $parameters['email'] = $email;
                
                $query = "SELECT * FROM " . $this->tableName . " WHERE (email = :email);";
                
                $this->connection = Connection::GetInstance(); 

                $resultSet = $this->connection->Execute($query, $parameters);
                
                if($resultSet) {
                    $newResultSet = $this->mapear($resultSet);

                    return  $newResultSet[0];
                }
                return false;
            }
            
            catch(PDOException $e) {
                    echo $e->getMessage();
            }
        }

        public function getUserById($id) {
            try {
                $parameters['user_id'] = $id;
                
                $query = "SELECT * FROM " . $this->tableName . " WHERE (user_id = :user_id);";
                
                $this->connection = Connection::GetInstance(); 

                $resultSet = $this->connection->Execute($query, $parameters);
                
                if($resultSet) {
                    $newResultSet = $this->mapear($resultSet);

                    return  $newResultSet[0];
                }
                return false;
            }
            
            catch(PDOException $e) {
                    echo $e->getMessage();
            }
        }

        public function getAll() {
            try {
                $query = "SELECT * FROM " . $this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                if($resultSet)
                {
                    $newResultSet = $this->mapear($resultSet);
                
                    return  $newResultSet;
                }

                return  false;

            }
            
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function mapear($value) {
            
            $resp = array_map(function($p) {
                $user = new User();
                $user->setId($p['user_id']);
                $user->setName($p['user_name']);
                $user->setLastName($p['user_last_name']);
                $user->setEmail($p['email']);
                $user->setPassword($p['user_password']);
                $user->setBirthDate($p['birth_date']);
                $user->setRole($p['user_role']);

                return $user;
            }, $value);

            return $resp;
        }
    }
