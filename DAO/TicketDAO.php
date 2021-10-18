<?php 

    namespace DAO;

    use Models\Ticket as Ticket;
    use DAO\Connection as Connection;

    class TicketDAO 
    {
        private $connection;
        private $tableName = "tickets";

        public function add(Ticket $ticket) 
        {
            try 
            {
                $query = "INSERT INTO " . $this->tableName . " (purchase_id) VALUES (:purchase_id);";

                $parameters["purchase_id"] = $ticket->getPurchaseId();

                $this->connection = Connection::GetInstance();
                
                $this->connection->ExecuteNonQuery($query,$parameters);

                $query = "SELECT LAST_INSERT_ID();";

                $this->connection = Connection::GetInstance();
                
                $resultSet = $this->connection->Execute($query);

                return $resultSet[0]["LAST_INSERT_ID()"];
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getTicket($id) 
        {
            try 
            {
                $parameters['ticket_id'] = $id;
                
                $query = "SELECT * FROM " . $this->tableName . " WHERE (ticket_id = :ticket_id);";
                
                $this->connection = Connection::GetInstance(); 

                $resultSet = $this->connection->Execute($query, $parameters);
                
                if($resultSet) {
                    $newResultSet = $this->mapear($resultSet);

                    return  $newResultSet[0];
                }
                return false;
            }
            
            catch(PDOException $e) 
            {
                    echo $e->getMessage();
            }
        }

        public function getAll() {
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
                $ticket = new Ticket();
                $ticket->setId($p['ticket_id']);
                $ticket->setPurchaseId($p['purchase_id']);
                return $ticket;
            }, $value);

            return $resp;
        }
    }
