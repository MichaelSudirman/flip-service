<?PHP
$data = array('bank_code' => 'bni', 'account_number' => 1234567890, 'amount' => 10000, 'remark' => 'this is a test');

  $errno=-1;
  $errstr=''; 
  $fs = fsockopen($url,$port,$errno,$errstr); 
  if( $fs === false ) { // Some error handling } 
 
  $header = "POST $url HTTP/1.0\r\n"; 
  $header .= "Content-Type: application/x-www-form-urlencoded\r\n"; 
  $header .= "Content-Length: " . strlen($data) . "\r\n\r\n"; 
  fputs($fs, $header . $data ); 
 
  // Find out what the page returns as its body 
  $reply = ''; 
  while( !feof($fs) ) { 
    $reply .= fgets($fp,8192); 
  } 
?>