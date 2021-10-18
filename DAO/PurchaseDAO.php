<?php 

    namespace DAO;

    use Models\Purchase as Purchase;
    use DAO\Connection as Connection;

    class PurchaseDAO {
        private $connection;
        private $tableName = "purchases";

        public function add(Purchase $purchase) 
        {
            try 
            {
                $query = "INSERT INTO " . $this->tableName . " (ticket_amount, total, purchase_date, user_id, projection_id) VALUES (:ticket_amount, :total, :purchase_date, :user_id, :projection_id);";

                $parameters["ticket_amount"] = $purchase->getTicketAmount();
                $parameters["total"] = $purchase->getTotal();
                $parameters["purchase_date"] = $purchase->getDate();
                $parameters["user_id"] = $purchase->getUserId();
                $parameters["projection_id"] = $purchase->getProjectionId();

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

        public function getPurchase($id) 
        {
            try 
            {
                $parameters['purchase_id'] = $id;
                
                $query = "SELECT * FROM " . $this->tableName . " WHERE (purchase_id = :purchase_id);";
                
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
                $purchase = new Purchase();
                $purchase->setId($p['purchase_id']);
                $purchase->setTicketAmount($p['ticket_amount']);
                $purchase->setTotal($p['total']);
                $purchase->setDate($p['purchase_date']);
                $purchase->setUserId($p['user_id']);
                $purchase->setProjectionId($p['projection_id']);
                return $purchase;
            }, $value);

            return $resp;
        }        
    }
