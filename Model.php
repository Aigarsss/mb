<?php

    Class Model{

        private $host = "localhost";
        private $userName = "root";
        private $password = "";
        private $dbName = "mbdb";
        private $conn;
        

        public function __construct() {
            try {
                $this->conn = new PDO('mysql:host='. $this->host .';dbname='. $this->dbName, $this->userName, $this->password);
                $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

            } catch (exception $e) {
                echo "connection failed" . $e->getMessage();
            }
        }

        
        // insert records
        public function insert(){

            if (isset($_POST['submit'])) {
     
                $errors = $this->validate();
                // - Return the errors
                if (sizeof($errors) > 0) {
                    return $errors;
                }


                if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['terms'])) {
                
                    $inputEmail = $_POST['email'];
                    $domain = substr($inputEmail, strpos($inputEmail, '@') + 1);
                    $provider = substr($inputEmail, strpos($inputEmail, '@') + 1, strpos($domain, '.'));

                    try {

                        $statement = $this->conn->prepare("insert into subscribers(email, provider ) VALUES(:email, :provider)");
                        $statement->execute(['email' => $inputEmail, 'provider' => $provider]);

                        // var_dump($_POST);
                        header("Location: /success.php");
                        exit();
        
                    } catch (Exception $e) {
                        die($e->getMessage());
                    }

                } else {
                    // error handling
                    echo "Something went wrong";

                }

            } 
        }

        //read records
        public function readAll(){

            $statement = $this->conn->prepare("SELECT * FROM SUBSCRIBERS order by date desc");
            $statement->execute();

            $data = $statement->fetchAll();

            return $data;

    }

        //delete records
        public function delete($id){

            try {

                $statement = $this->conn->prepare("DELETE FROM SUBSCRIBERS where id = :id");
                $statement->execute(['id' => $id]);

            } catch (Exception $e) {
                die($e->getMessage());
            }    
        }

        // filter buttons for subscribers.php
        public function getProviders(){
  
                // $_SESSION["search"] 
                // $_SESSION["filter"] 
                // $_SESSION["order"]
                // $_SESSION["direction"] 

            try {

                $statement = $this->conn->prepare("select distinct(provider) from subscribers");
                $statement->execute();

                $data = $statement->fetchAll();

                return $data;

            } catch (Exception $e) {
                die($e->getMessage());
            }    

        }

        // filtering for the subscribers.php page
        public function filterProvider(){

            // simplified ordering

            if (isset($_GET['orderBy']) && isset($_GET['direction'])) {
                $ordering = $_GET['orderBy'];
                $direction = $_GET['direction'];

                $statement = $this->conn->prepare("select * from subscribers order by $ordering $direction");
                $statement->execute();

                $data = $statement->fetchAll();

                return $data;
            }


            if (isset($_GET['filter'])) {
                $filter = $_GET['filter'];

                if ($filter == "search" && isset($_GET['search'])) {
                    
                    $searchTerm = $_GET['search'];

                    $statement = $this->conn->prepare("select * from subscribers where email like CONCAT('%', :searchTerm, '%') order by date desc");
                    $statement->execute(["searchTerm" => $searchTerm]);

                } else if ($filter == "All") {
                    $statement = $this->conn->prepare("select * from subscribers  order by date desc");
                    $statement->execute();
                } else {
                    $statement = $this->conn->prepare("select * from subscribers where provider = :filter order by date desc");
                    $statement->execute(["filter" => $filter]);
                }

                $data = $statement->fetchAll();
    
                return $data;

            }

        }

        private function validate(){

            $errors = array();

            // - Provided email is ending with .co - “We are not accepting subscriptions from Colombia emails”.
            if (preg_match('/.co$/', $_POST["email"])) {
                $errors["co"] = "We are not accepting subscriptions from Colombia emails";
            }

            // - No email address is provided - “Email address is required”
            if (!isset($_POST['email']) || empty($_POST['email'])) {
                $errors["email"] = "Missing email";
            } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {           // - Invalid email is added - “Please provide a valid e-mail address”
                    $errors["invalidEmail"] = "Please provide a valid e-mail address";
                    }


            // - The checkbox is not marked - “You must accept the terms and conditions”
            if (!isset($_POST['terms'])) {
                $errors["checkbox"] = "You must accept the terms and conditions";
            }

            return $errors;

        }
}

?>
