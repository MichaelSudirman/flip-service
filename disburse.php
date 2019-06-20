<html>

    <head>
        <link rel="stylesheet" href="style.css" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    </head> 

    <body>

        <h1>Check Transaction</h1>
        <form action="" method="POST">
            <div class="handler">   
                <label>Id:</label>
                <br>
                <input type="text" name="id" class="Input" style="width: 225px" required>
                <br>
                <input type="submit" name="get_submit" value="Submit" class="Submit">
                <br>
            </div>
        </form>

        <h1>Create Transaction</h1>
        <form action="" method="POST">
            <div class="handler">
                <label>Bank Code:</label>
                <br>
                <input type="text" name="bank_code" class="Input" style="width: 225px" required>
                <br>
                <label>Account Number:</label>
                <br>
                <input type="text" name="account_number" class="Input" style="width: 225px" required>
                <br>
                <label>Amount:</label>
                <br>
                <input type="text" name="amount" class="Input" style="width: 225px" required>
                <br>
                <label>Remark:</label>
                <br>
                <input type="text" name="remark" class="Input" style="width: 225px" required>
                
                <br>
                <input type="submit" name="post_submit" value="Submit" class="Submit">
                <br>
            </div>
        </form>

    </body>

</html>
<?php
    include 'FlipStation.php';

    $flipStation = new FlipStation;
    $result = $flipStation->main();
    echo $result;
    
?>