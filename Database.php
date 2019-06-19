<?php
    class Database {
        private static $instance = null;
        private static $connection = null;
        // Might want to change 3 variables below according to your mysql settings
        private const USERNAME = 'root';
        private const PASSWORD = '';
        private const DB_NAME = 'flip_db';

        private function __construct()
        {
            // Initialize and check connection
            if(Database::$instance == null){
                Database::$connection = mysqli_connect('localhost', Database::USERNAME, Database::PASSWORD);
                if (Database::$connection->connect_error) {
                    die("Connection failed: " . Database::$connection->connect_error);
                } 
                // Initialize database selection
                mysqli_select_db(Database::$connection, Database::DB_NAME);
            }
            else{
                throw new Exception("Attempt to instantiate another singleton Database!");
            }
        }

        // Singleton feature
        public static function getInstance()
        {
            if (Database::$instance == null)
            {
            Database::$instance = new Database();
            }
            return Database::$instance;
        }

        public function migrateDatabase()
        {
            Database::getInstance();
            $sql_query = "CREATE TABLE IF NOT EXISTS `FLIP_DISBURSEMENT` (
                `ID` int(11),
                `STATUS` varchar(10),
                `RECEIPT` varchar(255),
                `TIME_SERVED` DATETIME,
                PRIMARY KEY (`ID`)
            );";
            $success = mysqli_query(Database::$connection,$sql_query) or die (mysqli_error(Database::$connection));
            if ($success) {
                echo "Migration is run successfully!";
            } else {
                echo "Migration is not run successfully...";
            }        
        }

        public function closeConnection()
        {
            Database::getInstance();
	        mysqli_close(Database::$connection);
        }
    }
?>