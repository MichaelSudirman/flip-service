<html>

<head>
    <link rel="stylesheet" href="styles.css" type="text/css">
    <link href="https://fonts.google.com/specimen/Roboto?selection.family=Roboto" rel="stylesheet">
</head>

<body>
    <section id="header">
        Flip API Service
    </section>
    <section id="body">
        <div class="create-transaction">
            <form action="" method="POST">
                <div class="handler-header">
                    Create Transaction
                </div>
                <div class="handler-content">
                    <div class="handler-content">
                        <label>Bank Code:</label>
                        <input type="text" name="bank_code" class="Input" required>
                    </div>

                    <div class="handler-content">
                        <label>Account Number:</label>
                        <input type="text" name="account_number" class="Input" required>
                    </div>

                    <div class="handler-content"> <label>Amount:</label>

                        <input type="text" name="amount" class="Input" required>
                    </div>
                    <div class="handler-content">
                        <label>Remark:</label>

                        <input type="text" name="remark" class="Input" required>
                    </div>
                    <div class="handler-content">
                        <input type="submit" name="post_submit" value="SUBMIT" class="submit-button">
                    </div>
                </div>
            </form>
        </div>
        <div class="horizontal-border"></div>
        <div class="check-transaction">
            <form action="" method="POST">
                <div class="handler-header">
                    Check Transaction
                </div>
                <div class="handler-content">
                    <label>Id:</label>
                    <input type="text" name="id" class="Input" class="label-input" required>
                </div>
                <div class="handler-content">
                    <input type="submit" name="get_submit" value="SUBMIT" class="submit-button">
                </div>
            </form>
        </div>


    </section>

</body>

</html>
<?php
include 'flipStation.php';

$flipStation = new FlipStation;
$flipStation->main();

?>