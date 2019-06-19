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
                Database::$connection = mysqli_connect('localhost', Database::USERNAME, Database::PASSWORD);
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

        public function executeThenInsert($input)
        {
            Database::getInstance();
            // $sql_query = "INSERT INTO FLIP_DISBURSEMENT ()";
            // $mysqli = Database::$connection->prepare('SELECT * FROM FLIP_DISBURSEMENT');
            // $mysqli.prepare()
            // $mysqli = new mysqli("localhost", Database::USERNAME, Database::PASSWORD, Database::DB_NAME);
            // $mysqli->connect_errno;
            // try 
            // {
            // echo $input['id'];
            // $stmt = Database::$connection->prepare('INSERT INTO FLIP_DISBURSEMENT(ID, AMOUNT, STATUS, TIMESTAMP, BANK_CODE, ACCOUNT_NUMBER, BENEFICIARY_NAME, REMARK, RECEIPT, TIME_SERVED, FEE) VALUES 
            // (45123, 0, "status", "2019-06-19 22:23:25", "bank_code", "account_number", "beneficiary_name", "remark","receipt" , "2019-06-19 22:14:25", 0);');
            foreach ($input as $k => $v) {
                echo "\$input[$k] => $v, " . gettype($v) . "<br>";
            }
            echo "flag";
            $stmt = Database::$connection->prepare('SELECT COUNT(*) FROM FLIP_DISBURSEMENT;');
            $stmt->execute();
                
            /* bind result variables */
            $stmt->bind_result($value);

            /* fetch value */
            $stmt->fetch();
            echo "value: $value";

            /* close statement */
            $stmt->close();


            var_dump($input);
            if($input['receipt'] === null){
                echo "true flag";
            }
            else{
                echo "false flag";
            }
            $id = $input['id'];
            $amount = $input['amount'];
            $status = $input['status'];
            $timestamp = $input['timestamp'];
            $bank_code = $input['bank_code'];
            $account_number = $input['account_number'];
            $beneficiary_name = $input['beneficiary_name'];
            $remark = $input['remark'];
            $receipt = null;
            $time_served = $input['time_served'];
            $fee = $input['fee'];
            echo "bankcode: ". gettype($bank_code);
            echo "<br><br><br><br><br><br>";
            var_dump($input);
            echo "<br>";
            var_dump($id);
            echo "<br><br><br><br><br><br>a<br>";
            var_dump("INSERT INTO FLIP_DISBURSEMENT(ID, AMOUNT, STATUS, TIMESTAMP, BANK_CODE, ACCOUNT_NUMBER, BENEFICIARY_NAME, REMARK, RECEIPT, TIME_SERVED, FEE) VALUES 
            ($id, $amount, '$status', '$timestamp', '$bank_code', '$account_number', '$beneficiary_name', '$remark','$receipt', '$time_served', $fee);");
            // $sql_query = 'INSTERT INTO `FLIP_DISBURSEMENT` (';
            // foreach ($input as $key => $value) {
            //     if (in_array($value, array('id','amount','fee'), true ) ) {
            //         $sql_query .= $key;
            //     }
            //     else{
            //         $sql_query .= '`' . $key . '`';
            //     }
            // }
            // $sql_query .= ') VALUES (';
            // foreach ($array as $value) {
            //     if (in_array($value, array('id','amount','fee'), true ) ) {
            //         $sql_query .= $value;
            //     }
            //     else{
            //         $sql_query .= '`' . $value . '`';
            //     }
            // }
            // $sql_query .= ')';
            $stmt = Database::$connection->prepare("INSERT INTO FLIP_DISBURSEMENT VALUES 
            ($id, $amount, '$status', '$timestamp', '$bank_code', '$account_number', '$beneficiary_name', '$remark','$receipt', '$time_served', $fee);");
            
            // $stmt = Database::$connection->prepare($sql_query);
            echo "<br><br><br><br><br><br><br>b";
           
            // $stmt = Database::$connection->prepare("INSERT INTO FLIP_DISBURSEMENT VALUES 
            // (/$id, /$amount, /$status, /$timestamp, /$bank_code, /$account_number, /$beneficiary_name, /$remark,/$receipt , /$time_served, /$fee);");
            $stmt->execute(); 





            // $stmt = Database::$connection->prepare('INSERT INTO FLIP_DISBURSEMENT(ID, AMOUNT, STATUS, TIMESTAMP, BANK_CODE, ACCOUNT_NUMBER, BENEFICIARY_NAME, REMARK, RECEIPT, TIME_SERVED, FEE) VALUES 
            // (345345345, $input["amount"], $input["status"], $input["timestamp"], $input["bank_code"], $input["account_number"], $input["beneficiary_name"], $input["remark"],$input["receipt"] , $input["time_served"], $input["fee"]);');
            // $stmt->execute(); 

            // $stmt = Database::$connection->prepare("INSERT INTO FLIP_DISBURSEMENT VALUES 
            // (123123123, 5, 'asd', '2019-06-19 22:14:25', 'bank code', 'account number', 'beneficiary name', 'remark','receipt', '2019-06-19 22:14:25', 123);");
            // $stmt->execute(); 

                
            // catch(Exception $e)
            // {
            // die('Connection failed:' . $e->getMessage()); //En cas d'erreur, on affiche un message et on arrete tout
            // }
            // $stmt = Database::$connection->prepare('INSERT INTO FLIP_DISBURSEMENT(ID, AMOUNT, STATUS, TIMESTAMP, BANK_CODE, ACCOUNT_NUMBER, BENEFICIARY_NAME, REMARK, RECEIPT, TIME_SERVED, FEE) 
            // VALUES (:id, :amount, :status, :timestamp, :bank_code, :account_number, :beneficiary_name, :remark, :receipt, :time_served, :fee);');
            // $stmt = Database::$connection->prepare('INSERT INTO FLIP_DISBURSEMENT(ID, AMOUNT, STATUS, TIMESTAMP, BANK_CODE, ACCOUNT_NUMBER, BENEFICIARY_NAME, REMARK, RECEIPT, TIME_SERVED, FEE) 
            // VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
            // $stmt->execute(array(2, 0, "status", "2019-06-19 22:23:25", "bank_code", "account_number", "beneficiary_name", "remark","receipt" , "2019-06-19 22:14:25", 0));
            // echo "stmt: $stmt<br>"; 
            // echo "<br>";
            // $stmt->execute(array(':id' => $input['id'],':amount' => $input['amount'],':status' => $input['status'],
            // ':timestamp' => $input['timestamp'],':bank_code' => $input['bank_code'],':account_number' => $input['account_number'],
            // ':beneficiary_name' => $input['beneficiary_name'],':remark' => $input['remark'],':receipt' => $input['receipt'],
            // ':time_served' => $input['time_served'],':fee' => $input['fee']));
        }

        public function migrateDatabase()
        {
            Database::getInstance();
            $sql_query = "CREATE TABLE IF NOT EXISTS `FLIP_DISBURSEMENT` (
                `ID` INT(20),
                `AMOUNT` INT(15),
                `STATUS` VARCHAR(10),
                `TIMESTAMP` DATETIME,
                `BANK_CODE` VARCHAR(10),
                `ACCOUNT_NUMBER` VARCHAR(20),
                `BENEFICIARY_NAME` VARCHAR(20),
                `REMARK` VARCHAR(50),
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