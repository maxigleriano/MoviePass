<?php 

    namespace DAO;

    use Models\MovieGenre as MovieGenre;
    use DAO\Connection as Connection;

    class MovieGenreDAO {
        private $connection;
        private $tableName = "genres";

        public function add(MovieGenre $genre) {
            try {
                $query = "INSERT INTO " . $this->tableName . " (genre_id, genre_name) VALUES (:genre_id, :genre_name);";

                $parameters["genre_id"] = $theater->getId();
                $parameters["genre_name"] = $theater->getName();

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

                $query = "DELETE FROM " . $this->tableName . " WHERE (genre_id = :genre_id);";

                $this->connection = Connection::GetInstance();

                $parameters['genre_id'] = $id;

                $this->connection->ExecuteNonQuery($query,$parameters);

            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        public function modify($id, MovieGenre $newGenre) {
            try
            {
                $query = "UPDATE " . $this->tableName . " SET genre_name = :genre_name WHERE (genre_id = :genre_id);";

                $this->connection = Connection::GetInstance();

                $parameters["genre_id"] = $id;
                $parameters["genre_name"] = $newGenre->getName();

                $this->connection->ExecuteNonQuery($query,$parameters);

            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }   

        public function getGenre($id) {
            try {
                $parameters['genre_id'] = $id;
                
                $query = "SELECT * FROM " . $this->tableName . " WHERE (genre_id = :genre_id);";
                
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
                $parameters['genre_name'] = $name;
                
                $query = "SELECT * FROM " . $this->tableName . " WHERE (genre_name = :genre_name);";
                
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
                return new MovieGenre ($p['genre_id'],$p['genre_name']);
            }, $value);

            return $resp;
        }
    }

?>