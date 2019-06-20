<?php
    class Database {
        private static $instance = null;
        public static $connection = null;
        // Might want to change 3 variables below according to your mysql settings
        private const USERNAME = 'root';
        private const PASSWORD = '';
        private const DB_NAME = 'flip_db';
        private function __construct()
        {
            // Initialize and check connection
            if(Database::$instance == null){
                Database::$connection = mysqli_connect('127.0.0.1', Database::USERNAME, Database::PASSWORD);
                if (Database::$connection->connect_error) {
                    die ("Connection failed: " . Database::$connection->connect_error);
                } 
                // Initialize database selection
                mysqli_select_db(Database::$connection, Database::DB_NAME);
            }
            else{
                die ("Attempt to instantiate another singleton Database!");
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

        public function executeThenInsert($array)
        {
            Database::getInstance();
            $id = $array['id'];
            $amount = $array['amount'];
            $status = $array['status'];
            $timestamp = $array['timestamp'];
            $bank_code = $array['bank_code'];
            $account_number = $array['account_number'];
            $beneficiary_name = $array['beneficiary_name'];
            $remark = $array['remark'];
            $receipt = $array['receipt'];
            $time_served = $array['time_served'];
            $fee = $array['fee'];
            $sql_query = "INSERT INTO FLIP_DISBURSEMENT VALUES 
            ($id, $amount, '$status', '$timestamp', '$bank_code', '$account_number', '$beneficiary_name', '$remark','$receipt', '$time_served', $fee);";
            Database::executeThenCommit($sql_query);
        }

        public function executeThenCommit($sql_query){
            $stmt = Database::$connection->prepare($sql_query);
            $stmt->execute(); 
        }

        public function migrateDatabase()
        {
            Database::getInstance();
            $sql_query = "CREATE TABLE IF NOT EXISTS `FLIP_DISBURSEMENT` (
                `ID` DOUBLE(25,1),
                `AMOUNT` INT(15) NOT NULL,
                `STATUS` VARCHAR(10),
                `TIMESTAMP` DATETIME,
                `BANK_CODE` VARCHAR(10) NOT NULL,
                `ACCOUNT_NUMBER` VARCHAR(20) NOT NULL,
                `BENEFICIARY_NAME` VARCHAR(20),
                `REMARK` VARCHAR(50) NOT NULL,
                `RECEIPT` VARCHAR(255),
                `TIME_SERVED` DATETIME,
                `FEE` INT(15),
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