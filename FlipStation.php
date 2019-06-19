<?php
    include 'Database.php';
    
   
    class FlipStation {
        private const PREFIX_URL = "https://";
        private const URL = "nextar.flip.id/disburse";
        private const USERNAME = "HyzioY7LP6ZoO7nTYKbG8O4ISkyWnX1JvAEVAhtWKZumooCzqp41";
        private const PASSWORD = "";

        public function main() {
            echo "number of POST: " . (count($_POST)) . "<br>";
            if(count($_POST)){
                foreach ($_POST as $value) {
                    echo "$value <br>";
                }
                // var_dump($_POST);
                if(isset($_POST['get_submit'])){
                    // echo "Calling GetSubmit POST";
                    $result = $this->getRequest();
                    return $result;

                }
                if(isset($_POST['post_submit'])){
                    return $this->postRequest();
                }
            }
        }

        public function getRequest(){
            $id = $_POST['id'];
            if($id === NULL){
                return 'Please fill out the required Id';
            }
            $get_url = FlipStation::PREFIX_URL . FlipStation::URL . '/' . $id;
            $username = FlipStation::USERNAME;
            $password = FlipStation::PASSWORD;
            $options = array(
                'http'=>array(
                  'method'=>"GET",
                  'header' => "Authorization: Basic " . base64_encode("$username:$password")                 
                )
            );
            $context = stream_context_create($options);
            // Open the file using the HTTP headers set above
            $response = file_get_contents($get_url, false, $context);
            echo "response:";
            echo $response;
            echo "<br>";
            $cleaned_response = str_replace("{","",$response);
            $cleaned_response = str_replace("}","",$cleaned_response);
            $cleaned_response = (explode(",", $cleaned_response));
            $result = '';
            foreach ($cleaned_response as $value) {
                $result .= $value . "<br>";
            }
            return $result;
        }

        public function postRequest(){
            $bank_code = $_POST['bank_code'];
            $account_number = $_POST['account_number'];
            $amount = $_POST['amount'];
            $remark = $_POST['remark'];
            $auth = FlipStation::USERNAME . ':' . FlipStation::PASSWORD . '@';
            $post_url = FlipStation::PREFIX_URL . $auth . FlipStation::URL; 
            
            $data = http_build_query(array(
                'bank_code' => $bank_code,
                'account_number' => $account_number,
                'amount' => $amount, 
                'remark' => $remark));

            $options = array('http' => array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => $data
            ));
            $context = stream_context_create($options);
            $file_open = fopen($post_url, 'rb', false, $context);
            // Read the POST data
            $result = '';
            // foreach ($file_open as $value) {
            //     $result .= $value . "<br>";
            // }
            // return $result;
            $file = stream_get_contents($file_open);
            return $file;
            // echo $post_url;
            // return "TODO";
        }
    }
?>