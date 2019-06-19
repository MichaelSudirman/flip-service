<!-- bank_code
account_number
amount
remark -->

<?php


$username = "some-username";
$password = "some-password";
$data = array('bank_code' => 'bni', 'account_number' => 1234567890, 'amount' => '10000', 'remark' => 'this is a test');

$url = 'https://nextar.flip.id';
$opts = array(
    'http' => array(
        'method' => "GET",
        'header' => "Accept-language: en\r\n" .
            "Authorization: Basic " .
            base64_encode("$username:$password")
    )
);

$context = stream_context_create($opts);
$file = file_get_contents($url, false, $opts);

print($file);
/* Sends an http request to www.example.com
        with additional headers shown above */
$fp = fopen('https://nextar.flip.id/disburse', 'r', false, $context);
// print($fp);
// fpassthru($fp);
fclose($fp);

// $data = array('bank_code' => 'bni', 'account_number' => 1234567890, 'amount' => '10000', 'remark' => 'this is a test');
// // $data = array('key1' => 'value1', 'key2' => 'value2');
// $secret_key = 'HyzioY7LP6ZoO7nTYKbG8O4ISkyWnX1JvAEVAhtWKZumooCzqp41';

// // use key 'http' even if you send the request to https://...
// $options = array(
//     'http' => array(
//         'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
//         'method'  => 'POST',    
//         'content' => http_build_query($data)
//     )
// );
// $context  = stream_context_create($options);
// $result = file_get_contents($url, false, $context);
// if ($result === FALSE) { /* Handle error */ }

// var_dump($result);
?>