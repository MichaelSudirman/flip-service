<?php
    include 'Database.php';
    
    class FlipStation {
        public function main() {
            if(count($_POST)){
                if($_POST['GetSubmit']){
                    return $this->getRequest();
                }if($_POST['PostSubmit']){
                    return $this->postRequest();
                }
            }
        }

        public function getRequest(){
            $Id = $_POST['Id'];
            if($Id === NULL){
                return 'Please fill out the required Id';
            }
            return $Id;
            
        }

        public function postRequest(){
            return "TODO";
        }
    }
?>