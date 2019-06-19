<?php

$url = "https://HyzioY7LP6ZoO7nTYKbG8O4ISkyWnX1JvAEVAhtWKZumooCzqp41:@nextar.flip.id/disburse";
// $username = "HyzioY7LP6ZoO7nTYKbG8O4ISkyWnX1JvAEVAhtWKZumooCzqp41";
// $password = "";
$data = http_build_query(array('bank_code' => 'bni', 'account_number' => 1234567890, 'amount' => 10000, 'remark' => 'this is a test'));
var_dump($data);
$options;
// Set the headers
$options = array('http' =>
array(
    'method' => 'POST',
    'header' => 'Content-type: application/x-www-form-urlencoded',
    'content' => $data
));

// Send the POST data
$context = stream_context_create($options);
$file_open = fopen($url, 'rb', false, $context);
// Read the POST data
$file = stream_get_contents($file_open);
print($file);
// $result = var_export($http_response_header,true);
?>