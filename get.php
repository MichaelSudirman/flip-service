<?PHP

$username = "HyzioY7LP6ZoO7nTYKbG8O4ISkyWnX1JvAEVAhtWKZumooCzqp41";
$password = "";
$remote_url = 'https://HyzioY7LP6ZoO7nTYKbG8O4ISkyWnX1JvAEVAhtWKZumooCzqp41:@nextar.flip.id/disburse/5535152564';

// Create a stream
$options = array(
  'http'=>array(
    'method'=>"GET",
    'header' => "Authorization: Basic " . base64_encode("$username:$password")                 
  )
);

$context = stream_context_create($options);
// Open the file using the HTTP headers set above
$result = file_get_contents($remote_url, false, $context);
echo $result;
echo "<br>";
$clean_result = str_replace("{","",$result);
  $clean_result = str_replace("}","",$result);
$array_result = (explode(",", $clean_result));
foreach ($array_result as $value) {
  echo "$value <br>";
}

?>