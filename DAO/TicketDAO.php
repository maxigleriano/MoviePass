<?php 

    namespace DAO;

    use Models\Ticket as Ticket;
    use DAO\Connection as Connection;

    class TicketDAO {
        private $connection;
        private $tableName = "tickets";

        public function add(Ticket $ticket) {
            try {
                $query = "INSERT INTO " . $this->tableName . " (purchase_id) VALUES (:purchase_id);";

                $parameters["purchase_id"] = $ticket->getPurchase();

                $this->connection = Connection::GetInstance();
                
                $this->connection->ExecuteNonQuery($query,$parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
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

        public function getOne($id) {
            try {
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
            
            catch(PDOException $e) {
                    echo $e->getMessage();
            }
        }

        public function getByProjection($projection_id) {
            try {
                $parameters['projection_id'] = $projection_id;
                
                $query = "SELECT * FROM " . $this->tableName . " WHERE (projection_id = :projection_id);";
                
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

        public function getByPurchase($purchase_id) {
            try {
                $parameters['purchase_id'] = $purchase_id;
                
                $query = "SELECT * FROM " . $this->tableName . " WHERE (purchase_id = :purchase_id);";
                
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

        public function mapear($value) {
            
            $resp = array_map(function($p) {
                return new Ticket ($p['ticket_id'], "",$p['purchase_id']);
            }, $value);

            return $resp;
        }
    }
?>