<?php
    include 'config.php';
    
    class Database {
        private static $instance = null;
        private static $connection = null;
        // Might want to change 3 variables below according to your mysql settings
        private function __construct()
        {
            // Initialize and check connection
            if(Database::$instance == null){
                Database::$connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);
                if (Database::$connection->connect_error) {
                    die ("Connection failed: " . Database::$connection->connect_error);
                } 
                // Initialize database selection
                mysqli_select_db(Database::$connection, DB_NAME);
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

        // Create an SQL Statement for  inserting FLIP_DISBUREMENT table
        public function insertToDatabase($array)
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
            $sql_query = "INSERT INTO `FLIP_DISBURSEMENT` VALUES 
            ($id, $amount, '$status', '$timestamp', '$bank_code', '$account_number', '$beneficiary_name', '$remark','$receipt', '$time_served', $fee);";
            Database::executeThenCommit($sql_query);
        }

        // Create an SQL Statement for updating FLIP_DISBUREMENT table
        public function updateToDatabase($array)
        {
            Database::getInstance();
            $id = $array['id'];
            $status = $array['status'];
            $receipt = $array['receipt'];
            $time_served = $array['time_served'];
            $fee = $array['fee']; 
            $sql_query = "UPDATE `FLIP_DISBURSEMENT`
            SET STATUS = '$status', RECEIPT ='$receipt' ,TIME_SERVED = '$time_served'
            WHERE ID = $id;";
            Database::executeThenCommit($sql_query);
        }
        
        // Prepare SQL statement and then execute
        public function executeThenCommit($sql_query){
            $stmt = Database::$connection->prepare($sql_query); 
            $stmt->execute();
        }

        // Table Creation
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

        // Closing connection, not needed at the moment 
        public function closeConnection()
        {
            Database::getInstance();
	        mysqli_close(Database::$connection);
        }
    }
?>