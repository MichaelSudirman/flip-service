<?php
    include 'database.php';
    
    class FlipStation {
        private $prefix_url = "https://";
        private $url = "nextar.flip.id/disburse";
        private $username = "HyzioY7LP6ZoO7nTYKbG8O4ISkyWnX1JvAEVAhtWKZumooCzqp41";
        private $password = "";

        // Check which POST request disburse and call the required function
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

        // Function for seding GET request to API
        public function getRequest(){
            $id = $_POST['id'];
            // Check if id is null
            if($id === NULL){
                return 'Please fill out the required Id';
            }
            // Prepare API request
            $get_url = $this->prefix_url . $this->url . '/' . $id;
            $username = $this->username;
            $password = $this->password;
            $options = array(
                'http'=>array(
                  'method'=>"GET",
                  'header' => "Authorization: Basic " . base64_encode("$username:$password")                 
                )
            );
            $context = stream_context_create($options);
            // Send API request and receive response
            $response = file_get_contents($get_url, false, $context);
            // Send response to database
            $json_response = json_decode($response, true);
            Database::updateToDatabase($json_response);
            // Create default message
            echo "<div class='result'>Data has been updated successfully!";
            echo "<pre>".json_encode($json_response,JSON_PRETTY_PRINT) . "</pre></div>";
            echo "<script>alert('Data successfully updated!')</script>";
        }

        // Function for sending POST request to API
        public function postRequest(){
            // Prepare API request
            $bank_code = $_POST['bank_code'];
            $account_number = $_POST['account_number'];
            $amount = $_POST['amount'];
            $remark = $_POST['remark'];
            // Another way of accessing basic auth via link
            $auth = $this->username . ':' . $this->password . '@';
            $post_url = $this->prefix_url . $auth . $this->url; 
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
            // Send API request and receive response
            $file_open = fopen($post_url, 'rb', false, $context);
            $response = stream_get_contents($file_open);
            // Send response to database
            $json_response = json_decode($response, true);
            Database::insertToDatabase($json_response);
            // Create default message
            echo "<div class='result'>Data has been inserted successfully!<pre>";
            echo "<pre>".json_encode($json_response,JSON_PRETTY_PRINT) . "</pre></div>";
            echo "<script>alert('Data successfully created!')</script>";
        }
    }
?>