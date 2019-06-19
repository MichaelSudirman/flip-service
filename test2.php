<!-- bank_code
account_number
amount
remark -->

<?php


$username = "HyzioY7LP6ZoO7nTYKbG8O4ISkyWnX1JvAEVAhtWKZumooCzqp41";
$password = "";
$data = array('bank_code' => 'bni', 'account_number' => 1234567890, 'amount' => 10000, 'remark' => 'this is a test');

$url = 'https://nextar.flip.id/disburse';
$opts = array(
    'http' => array(
        'method' => "POST",
        'header' => 
        "Authorization: Basic " .
            base64_encode("$username:$password"),
        'content' => $data
    )
);

$context = stream_context_create($opts);

// $file = file_get_contents($url, false, $opts);

// print($file);
/* Sends an http request to www.example.com
        with additional headers shown above */
$result = file_get_contents($url, false, $context);
var_dump($result);
?>