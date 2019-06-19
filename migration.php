<?php
    include 'Database.php';
    $database = Database::getInstance();
    // $database->initializeServer();
    // $database->initializeConnection();
    $database->migrateDatabase();
    $database->closeConnection()
    // Initialize Server
	// if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
	// 	$uri = 'https://';
	// } else {
	// 	$uri = 'http://';
	// }
    
    // // Initialize and check connection
	// $connection = mysqli_connect('localhost', 'root', '');
	// if ($connection->connect_error) {
	// 	die("Connection failed: " . $conn->connect_error);
	// } 
	
	// // Initialize database selection
	// mysqli_select_db($connection,'flip_db');
	
	// // Run commands to take form database
    // $sql_query = "CREATE TABLE IF NOT EXISTS `FLIP_DISBURSEMENT` (
    //     `ID` int(11),
    //     `STATUS` varchar(10),
    //     `RECEIPT` varchar(255),
    //     `TIME_SERVED` DATETIME,
    //     PRIMARY KEY (`ID`)
    // );";
    
    // $success = mysqli_query($connection,$sql_query) or die (mysqli_error($connection));
    // if ($success) {
    //     echo "Migration is run successfully!";
    // } else {
    //     echo "Migration is not  run successfully!";
    // }

	// // Initialize database
	// mysqli_close($connection);
?>