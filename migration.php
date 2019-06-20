<?php
    // Call migration from database
    include 'database.php';
    Database::migrateDatabase();
?>