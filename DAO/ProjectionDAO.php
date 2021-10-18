<?php 

    namespace DAO;

    use Models\Projection as Projection;
    use DAO\Connection as Connection;

    class ProjectionDAO 
    {
        private $connection;
        private $tableName = "projections";

        public function add(Projection $newProjection) 
        {
            try 
            {
                $query = "INSERT INTO " . $this->tableName . " (room_id, movie_id, projection_date, beginning_time, ending_time, available_seats) VALUES (:room_id, :movie_id, :projection_date, :beginning_time, :ending_time, :available_seats);";

                $parameters["room_id"] = $newProjection->getRoomId();
                $parameters["movie_id"] = $newProjection->getMovieId();
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

        public function delete($id) 
        {     
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

        public function modify(Projection $projection) 
        {
            try
            {
                $query = "UPDATE " . $this->tableName . " SET room_id = :room_id, movie_id = :movie_id, projection_date = :projection_date, beginning_time = :beginning_time, ending_time = :ending_time, available_seats = :available_seats, sold_seats = :sold_seats  WHERE (projection_id = :projection_id);";

                $this->connection = Connection::GetInstance();

                $parameters["projection_id"] = $projection->getId();
                $parameters["room_id"] = $projection->getRoomId();
                $parameters["movie_id"] = $projection->getMovieId();
                $parameters["projection_date"] = $projection->getDate();
                $parameters["beginning_time"] = $projection->getBeginningTime();
                $parameters["ending_time"] = $projection->getEndingTime();
                $parameters["available_seats"] = $projection->getAvailableSeats();
                $parameters["sold_seats"] = $projection->getSoldSeats();

                $this->connection->ExecuteNonQuery($query,$parameters);

            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }   

        public function getProjection($id) 
        {
            try {
                $parameters['projection_id'] = $id;
                
                $query = "SELECT * FROM " . $this->tableName . " WHERE (projection_id = :projection_id);";
                
                $this->connection = Connection::GetInstance(); 

                $resultSet = $this->connection->Execute($query, $parameters);
                
                if($resultSet) 
                {
                    $newResultSet = $this->mapear($resultSet);

                    return  $newResultSet[0];
                }
                return false;
            }
            
            catch(PDOException $e) {
                    echo $e->getMessage();
            }
        }

        public function getAll() 
        {
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

        public function getByDate($date)
        {
            try {
                $parameters['projection_date'] = $date;
                
                $query = "SELECT * FROM " . $this->tableName . " WHERE (projection_date = :projection_date);";
                
                $this->connection = Connection::GetInstance(); 

                $resultSet = $this->connection->Execute($query, $parameters);
                
                if($resultSet) 
                {
                    $newResultSet = $this->mapear($resultSet);

                    return  $newResultSet;
                }
                return false;
            }
            
            catch(PDOException $e) {
                    echo $e->getMessage();
            }
        }

        public function getByDateAndRoom($date, $room)
        {
            try {
                $parameters['projection_date'] = $date;
                $parameters['room_id'] = $room;
                
                $query = "SELECT * FROM " . $this->tableName . " WHERE (projection_date = :projection_date && room_id = :room_id);";
                
                $this->connection = Connection::GetInstance(); 

                $resultSet = $this->connection->Execute($query, $parameters);
                
                if($resultSet) 
                {
                    $newResultSet = $this->mapear($resultSet);

                    return  $newResultSet;
                }
                return false;
            }
            
            catch(PDOException $e) {
                    echo $e->getMessage();
            }
        }

        private function mapear($value) 
        {    
            $resp = array_map(function($p) {
                $projection = new Projection();
                $projection->setId($p['projection_id']);
                $projection->setRoomId($p['room_id']);
                $projection->setMovieId($p['movie_id']);
                $projection->setDate($p['projection_date']);
                $projection->setBeginningTime($p['beginning_time']);
                $projection->setEndingTime($p['ending_time']);
                $projection->setAvailableSeats($p['available_seats']);
                $projection->setSoldSeats($p['sold_seats']);
                return $projection;
            }, $value);

            return $resp;
        }
    }
