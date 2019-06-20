<?php
    include 'Database.php';
    
    class FlipStation {
        private const PREFIX_URL = "https://";
        private const URL = "nextar.flip.id/disburse";
        private const USERNAME = "HyzioY7LP6ZoO7nTYKbG8O4ISkyWnX1JvAEVAhtWKZumooCzqp41";
        private const PASSWORD = "";

        public function main() {
            if(count($_POST)){
                if(isset($_POST['get_submit'])){ 
                    return $this->getRequest();
                }
                elseif(isset($_POST['post_submit'])){
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
            $response = file_get_contents($get_url, false, $context);
            $json_response = json_decode($response, true);
            Database::updateToDatabase($json_response);
            echo "<div class='result'>Data has been updated successfully!";
            echo "<pre>".json_encode($json_response,JSON_PRETTY_PRINT) . "</pre></div>";
            echo "<script>alert('Data successfully updated!')</script>";
        }

        public function postRequest(){
            $bank_code = $_POST['bank_code'];
            $account_number = $_POST['account_number'];
            $amount = $_POST['amount'];
            $remark = $_POST['remark'];
            // Another way of accessing basic auth via link
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
            $response = stream_get_contents($file_open);
            $json_response = json_decode($response, true);
            Database::insertToDatabase($json_response);
            echo "<div class='result'>Data has been inserted successfully!<pre>";
            echo "<pre>".json_encode($json_response,JSON_PRETTY_PRINT) . "</pre></div>";
            echo "<script>alert('Data successfully created!')</script>";
        }
    }
?>