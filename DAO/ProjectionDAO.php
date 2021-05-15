<?php 

    namespace DAO;

    use Models\Projection as Projection;
    use DAO\Connection as Connection;

    class ProjectionDAO {
        private $connection;
        private $tableName = "projections";

        public function add(Projection $newProjection) {
            try {
                $query = "INSERT INTO " . $this->tableName . " (room_id, movie_id, projection_date, beginning_time, ending_time, available_seats) VALUES (:room_id, :movie_id, :projection_date, :beginning_time, :ending_time, :available_seats);";

                $parameters["room_id"] = $newProjection->getRoom();
                $parameters["movie_id"] = $newProjection->getMovie();
                $parameters["projection_date"] = $newProjection->getDate();
                $parameters["beginning_time"] = $newProjection->getBeginningTime();
                $parameters["ending_time"] = $newProjection->getEndingTime();
                $parameters["available_seats"] = $newProjection->getAvailableSeats();

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

                $query = "DELETE FROM " . $this->tableName . " WHERE (projection_id = :projection_id);";

                $this->connection = Connection::GetInstance();

                $parameters['projection_id'] = $id;

                $this->connection->ExecuteNonQuery($query,$parameters);

            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        public function modify($id, Projection $newProjection) {
            try
            {
                $query = "UPDATE " . $this->tableName . " SET room_id = :room_id, movie_id = :movie_id, projection_date = :projection_date, beginning_time = :beginning_time, ending_time = :ending_time, available_seats = :available_seats, sold_seats = :sold_seats  WHERE (projection_id = :projection_id);";

                $this->connection = Connection::GetInstance();

                $parameters["projection_id"] = $id;
                $parameters["room_id"] = $newProjection->getRoom();
                $parameters["movie_id"] = $newProjection->getMovie();
                $parameters["projection_date"] = $newProjection->getDate();
                $parameters["beginning_time"] = $newProjection->getBeginningTime();
                $parameters["ending_time"] = $newProjection->getEndingTime();
                $parameters["available_seats"] = $newProjection->getAvailableSeats();
                $parameters["sold_seats"] = $newProjection->getSoldSeats();

                $this->connection->ExecuteNonQuery($query,$parameters);

            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }   

        public function getProjection($id) {
            try {
                $parameters['projection_id'] = $id;
                
                $query = "SELECT * FROM " . $this->tableName . " WHERE (projection_id = :projection_id);";
                
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

        public function getByRoom($room_id) {
            try {
                $parameters['room_id'] = $room_id;
                
                $query = "SELECT * FROM " . $this->tableName . " WHERE (room_id = :room_id);";
                
                $this->connection = Connection::GetInstance(); 

                $resultSet = $this->connection->Execute($query, $parameters);
                
                if($resultSet) {
                    $newResultSet = $this->mapear($resultSet);

                    return  $newResultSet;
                }
                return false;
            }
            
            catch(PDOException $e) {
                    echo $e->getMessage();
            }
        }

        public function getByMovie($movie_id) {
            try {
                $parameters['movie_id'] = $movie_id;
                
                $query = "SELECT * FROM " . $this->tableName . " WHERE (movie_id = :movie_id);";
                
                $this->connection = Connection::GetInstance(); 

                $resultSet = $this->connection->Execute($query, $parameters);
                
                if($resultSet) {
                    $newResultSet = $this->mapear($resultSet);

                    return  $newResultSet;
                }
                return false;
            }
            
            catch(PDOException $e) {
                    echo $e->getMessage();
            }
        }

        public function getByDate($projection_date) {
            try {
                $parameters['projection_date'] = $projection_date;
                
                $query = "SELECT * FROM " . $this->tableName . " WHERE (projection_date = :projection_date);";
                
                $this->connection = Connection::GetInstance(); 

                $resultSet = $this->connection->Execute($query, $parameters);
                
                if($resultSet) {
                    $newResultSet = $this->mapear($resultSet);

                    return  $newResultSet;
                }
                return false;
            }
            
            catch(PDOException $e) {
                    echo $e->getMessage();
            }
        }

        public function getByDateAndRoom($projection_date, $room_id) {
            try {
                $parameters['projection_date'] = $projection_date;
                $parameters['room_id'] = $room_id;
                
                $query = "SELECT * FROM " . $this->tableName . " WHERE (projection_date = :projection_date && room_id = :room_id);";
                
                $this->connection = Connection::GetInstance(); 

                $resultSet = $this->connection->Execute($query, $parameters);
                
                if($resultSet) {
                    $newResultSet = $this->mapear($resultSet);

                    return  $newResultSet;
                }
                return false;
            }
            
            catch(PDOException $e) {
                    echo $e->getMessage();
            }
        }

        public function getFrom($projection_date) {
            try {
                $parameters['projection_date'] = $projection_date;
                
                $query = "SELECT * FROM " . $this->tableName . " WHERE (projection_date >= :projection_date);";
                
                $this->connection = Connection::GetInstance(); 

                $resultSet = $this->connection->Execute($query, $parameters);
                
                if($resultSet) {
                    $newResultSet = $this->mapear($resultSet); 

                    return  $newResultSet;
                }
                return false;
            }
            
            catch(PDOException $e) {
                    echo $e->getMessage();
            }
        }

        public function getFromDateAndMovie($projection_date, $movie_id) {
            try {
                $parameters['projection_date'] = $projection_date;
                $parameters['movie_id'] = $movie_id;
                
                $query = "SELECT * FROM " . $this->tableName . " WHERE (projection_date >= :projection_date && movie_id = :movie_id);";
                
                $this->connection = Connection::GetInstance(); 

                $resultSet = $this->connection->Execute($query, $parameters);
                
                if($resultSet) {
                    $newResultSet = $this->mapear($resultSet); 

                    return  $newResultSet;
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
                return new Projection ($p['projection_id'],$p['room_id'],$p['movie_id'],$p['projection_date'],$p['beginning_time'],$p['ending_time'], $p['available_seats'], $p['sold_seats']);
            }, $value);

            return $resp;
        }
    }

?>

