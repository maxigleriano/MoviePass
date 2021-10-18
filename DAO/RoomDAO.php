<?php 

    namespace DAO;

    use Models\Room as Room;
    use DAO\Connection as Connection;

    class RoomDAO 
    {
        private $connection;
        private $tableName = "rooms";

        public function add(Room $room) 
        {
            try 
            {
                $query = "INSERT INTO " . $this->tableName . " (theater_id, room_name, capacity, ticket_value) VALUES (:theater_id, :room_name, :capacity, :ticket_value);";

                $parameters["theater_id"] = $room->getTheaterId();
                $parameters["room_name"] = $room->getName();
                $parameters["capacity"] = $room->getCapacity();
                $parameters["ticket_value"] = $room->getTicketValue();

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

                $query = "DELETE FROM " . $this->tableName . " WHERE (room_id = :room_id);";

                $this->connection = Connection::GetInstance();

                $parameters['room_id'] = $id;

                $this->connection->ExecuteNonQuery($query,$parameters);

            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        public function modify(Room $room) 
        {
            try
            {
                $query = "UPDATE " . $this->tableName . " SET theater_id = :theater_id, room_name = :room_name, capacity = :capacity, ticket_value = :ticket_value WHERE (room_id = :room_id);";

                $this->connection = Connection::GetInstance();

                $parameters["room_id"] = $room->getId();
                $parameters["theater_id"] = $room->getTheaterId();
                $parameters["room_name"] = $room->getName();
                $parameters["capacity"] = $room->getCapacity();
                $parameters["ticket_value"] = $room->getTicketValue();

                $this->connection->ExecuteNonQuery($query,$parameters);

            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }   

        public function getRoom($id) {
            try {
                $parameters['room_id'] = $id;
                
                $query = "SELECT * FROM " . $this->tableName . " WHERE (room_id = :room_id);";
                
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

        public function getAll() 
        {
            try 
            {
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
            
            catch(PDOException $e) 
            {
                echo $e->getMessage();
            }
        }

        public function mapear($value) 
        {
            
            $resp = array_map(function($p) {
                $room = new Room();
                $room->setId($p['room_id']);
                $room->setTheaterId($p['theater_id']);
                $room->setName($p['room_name']);
                $room->setCapacity($p['capacity']);
                $room->setTicketValue($p['ticket_value']);
                return $room;
            }, $value);

            return $resp;
        }
    }
