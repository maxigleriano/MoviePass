<?php 

    namespace DAO;

    use Models\Purchase as Purchase;
    use DAO\Connection as Connection;

    class PurchaseDAO {
        private $connection;
        private $tableName = "purchases";

        public function add(Purchase $purchase) {
            try {
                $query = "INSERT INTO " . $this->tableName . " (ticket_amount, total, purchase_date, user_id, projection_id) VALUES (:ticket_amount, :total, :purchase_date, :user_id, :projection_id);";

                $parameters["ticket_amount"] = $purchase->getTickets();
                $parameters["total"] = $purchase->getTotal();
                $parameters["purchase_date"] = $purchase->getDate();
                $parameters["user_id"] = $purchase->getUser();
                $parameters["projection_id"] = $purchase->getProjection();

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
            
            catch(PDOException $e) {
                    echo $e->getMessage();
            }
        }

        public function getByDate($purchase_date) {
            try {
                $parameters['purchase_date'] = $purchase_date;
                
                $query = "SELECT * FROM " . $this->tableName . " WHERE (purchase_date = :purchase_date);";
                
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

        public function getByUser($user_id) {
            try {
                $parameters['user_id'] = $user_id;
                
                $query = "SELECT * FROM " . $this->tableName . " WHERE (user_id = :user_id);";
                
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

        public function getLastId(){
                
            try{
                $query = "SELECT purchase_id FROM " . $this->tableName ." order by purchase_id desc limit 1;";
               
                $this->connection = Connection :: GetInstance();
                $resultSet = $this->connection->Execute($query);

                if($resultSet) {
                    return $resultSet;
                }
                return false;
            }
            catch (PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        public function mapear($value) {
            
            $resp = array_map(function($p) {
                return new Purchase ($p['purchase_id'],$p['ticket_amount'],$p['total'],$p['purchase_date'],$p['user_id'],$p['projection_id']);
            }, $value);

            return $resp;
        }

        public function totalXmovies() {
            
            try {
                $query = "SELECT projections.movie_id as Pelicula, sum(purchases.ticket_amount) as TotalEntradas, sum(purchases.total) as Total 
                            FROM purchases inner join projections on purchases.projection_id = projections.projection_id group by Pelicula;";
                
                $this->connection = Connection::getInstance();
                $resultSet = $this->connection->execute($query);
                
                if($resultSet) {
                    return $resultSet;
                }
                return false;
            }
            catch (PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        public function totalXtheaters() {
            
            try {
                $query = "SELECT theaters.theater_name as Cine, sum(purchases.ticket_amount) as TotalEntradas, sum(purchases.total) as Total
                            FROM purchases inner join projections on purchases.projection_id = projections.projection_id
                            inner join rooms on projections.room_id = rooms.room_id
                            inner join theaters on rooms.theater_id = theaters.theater_id;";
                
                $this->connection = Connection::getInstance();
                $resultSet = $this->connection->execute($query);
                
                if($resultSet) {
                    return $resultSet;
                }
                return false;
            }
            catch (PDOException $e)
            {
                echo $e->getMessage();
            }
        }


        /////

        public function totalXmoviesDates($fecha1, $fecha2) {
            
            try {
                $query = "SELECT projections.movie_id as Pelicula, sum(purchases.ticket_amount) as TotalEntradas, sum(purchases.total) as Total 
                            FROM purchases inner join projections on purchases.projection_id = projections.projection_id where projection_date between $fecha1 and $fecha2 group by Pelicula;";
                
                $this->connection = Connection::getInstance();
                $resultSet = $this->connection->execute($query);
                
                if($resultSet) {
                    return $resultSet;
                }
                return false;
            }
            catch (PDOException $e)
            {
                echo $e->getMessage();
            }
        }
    }
?>