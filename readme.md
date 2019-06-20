# Flip Service

## How to run the service
- Have your MySQL and php server ready (I used XAMPP's MySQL and Apache on)
- If using XAMPP, place the folder under the htdocs
- Create a database server(default = flip_db) on your MySQL server
- Run migration.php via website with the url localhost/(directories)/migration.php
- Check your database server and see if a table is added
- You can change the constant variables in config.php
- run disburse.php via website with the url localhost/(directories)/disburse.php
- "Create Trasanction" form will perform POST request to the 3rd party API, whereas "Check Transaction" form will perform GET request to the 3rd party API
- To make the response clear, response json is placed under the form as well for both POST and GET request.
- Check your mySQL database and see if there is an inserted or updated commands

## Additional Note
- database.php handles connection to database
- disburse.php handles website UI
- flipStation.php handles API request & response
- config.php is used for keeping constant variables for mySQL connection
- migration.php will ask Database to create table under DB_NAME 