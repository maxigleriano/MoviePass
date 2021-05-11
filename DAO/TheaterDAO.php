<?php 

    namespace DAO;

    use Models\Theater as Theater;
    use DAO\Connection as Connection;

    class TheaterDAO {
        private $connection;
        private $tableName = "theaters";

        public function add(Theater $theater) {
            try {
                $query = "INSERT INTO " . $this->tableName . " (theater_name, address, opening_time, closing_time) VALUES (:theater_name, :address, :opening_time, :closing_time);";

                $parameters["theater_name"] = $theater->getName();
                $parameters["address"] = $theater->getAddress();
                $parameters["opening_time"] = $theater->getOpeningTime();
                $parameters["closing_time"] = $theater->getClosingTime();

                $this->connection = Connection::GetInstance();
                
                $this->connection->ExecuteNonQuery($query,$parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function delete($id) {     
            try 
            {

                $query = "DELETE FROM " . $this->tableName . " WHERE (theater_id = :theater_id);";

                $this->connection = Connection::GetInstance();

                $parameters['theater_id'] = $id;

                $this->connection->ExecuteNonQuery($query,$parameters);

            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        public function modify($id, Theater $newTheater) {
            try
            {
                $query = "UPDATE " . $this->tableName . " SET theater_name = :theater_name, address = :address, opening_time = :opening_time, closing_time = :closing_time WHERE (theater_id = :theater_id);";

                $this->connection = Connection::GetInstance();

                $parameters["theater_id"] = $id;
                $parameters["theater_name"] = $newTheater->getName();
                $parameters["address"] = $newTheater->getAddress();
                $parameters["opening_time"] = $newTheater->getOpeningTime();
                $parameters["closing_time"] = $newTheater->getClosingTime();

                $this->connection->ExecuteNonQuery($query,$parameters);

            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }   

        public function getTheater($id) {
            try {
                $parameters['theater_id'] = $id;
                
                $query = "SELECT * FROM " . $this->tableName . " WHERE (theater_id = :theater_id);";
                
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

        public function getByName($name) {
            try {
                $parameters['theater_name'] = $name;
                
                $query = "SELECT * FROM " . $this->tableName . " WHERE (theater_name = :theater_name);";
                
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
                return new Theater ($p['theater_id'],$p['theater_name'],$p['address'],$p['opening_time'],$p['closing_time']);
            }, $value);

            return $resp;
        }
    }

?>