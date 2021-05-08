<?php 

    namespace DAO;

    use DAO\QueryType as QueryType;
    use PDO;
    use PDOException;

    class Connection 
    {
        private $pdo = null;
        private $pdoStatement = null;
        private static $instance = null;

        public function __construct()
        {
            try 
            {
                $this->pdo = new PDO("mysql:host=".DB_HOST."; dbname=".DB_NAME, DB_USER, DB_PASS);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        public static function GetInstance()
        {
            if(self::$instance == null)
            {
                self::$instance = new Connection();
            }

            return self::$instance;
        }

        public function Execute($query,$parameters = array(),$queryType = QueryType::Query)
        {

            try
            {
                $this->Prepare($query);
                $this->BindParameters($parameters,$queryType);
                $this->pdoStatement->execute();

                return $this->pdoStatement->fetchAll();

            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }

        }

        public function ExecuteNonQuery($query, $parameters = array(), $queryType = QueryType::Query)
        {

            try
            {
                $this->Prepare($query);
                $this->BindParameters($parameters,$queryType);
                $this->pdoStatement->execute();

                return $this->pdoStatement->rowCount();

            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }

        }

        public function Prepare($query)
        {
            try
            {
                $this->pdoStatement = $this->pdo->prepare($query);
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        public function BindParameters($parameters, $queryType = QueryType::Query)
        {

            $i = 0;

            foreach($parameters as $parameterName=>$value)
            {   
                $i++;

                if($queryType == QueryType::Query)
                {   
                    $this->pdoStatement->bindParam(':'.$parameterName,$parameters[$parameterName]);
                }
                else
                {
                    $this->pdoStatement->bindParam($i,$parameters[$parameterName]);
                }
            }

        }


    }



?>