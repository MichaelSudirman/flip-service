<?php
    class Database {
        private static $instance = null;
        private $connection = null;
        // Might want to change 3 variables below according to your mysql settings
        private $username = 'root';
        private $password = '';
        private $db_name = 'flip_db';

        private function __construct()
        {
            $this->initializeServer();
            $this->initializeConnection();
        }

        public static function getInstance()
        {
            if (self::$instance == null)
            {
            self::$instance = new Database();
            }
        
            return self::$instance;
        }
        public function initializeServer()
        {
            if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
                $uri = 'https://';
            } else {
                $uri = 'http://';
            }
        }

        public function initializeConnection()
        {
            // Initialize and check connection
            $this->connection = mysqli_connect('localhost', $this->username, $this->password);
            if ($this->connection->connect_error) {
                die("Connection failed: " . $this->connection->connect_error);
            } 
            // Initialize database selection
            mysqli_select_db($this->connection, $this->db_name);
        }

        public function migrateDatabase()
        {
            $sql_query = "CREATE TABLE IF NOT EXISTS `FLIP_DISBURSEMENT` (
                `ID` int(11),
                `STATUS` varchar(10),
                `RECEIPT` varchar(255),
                `TIME_SERVED` DATETIME,
                PRIMARY KEY (`ID`)
            );";
            $success = mysqli_query($this->connection,$sql_query) or die (mysqli_error($this->connection));
            if ($success) {
                echo "Migration is run successfully!";
            } else {
                echo "Migration is not run successfully...";
            }        
        }

        public function closeConnection()
        {
	        mysqli_close($this->connection);
        }
    }
?>