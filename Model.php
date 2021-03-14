<?php

    Class Model {

        private $host = "localhost";
        private $userName = "root";
        private $password = "";
        private $dbName = "mbdb";
        private $conn;

        public function __construct() {


            try {
                $this->conn = new PDO('mysql:host='. $this->host .';dbname='. $this->dbName, $this->userName, $this->password);
                $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (exception $e) {
                echo "connection failed" . $e->getMessage();
            }
        }

        // insert records into DB from the landing

        public function insert(){

            if (isset($_POST['submit'])) {
     
                $errors = $this->validate();
                // - Return the errors
                if (count($errors) > 0) {
                    return $errors;
                }

                if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['terms'])) {
                
                    $inputEmail = $_POST['email'];
                    $domain = substr($inputEmail, strpos($inputEmail, '@') + 1);
                    $provider = substr($inputEmail, strpos($inputEmail, '@') + 1, strpos($domain, '.'));

                    try {

                        $statement = $this->conn->prepare("insert into subscribers(email, provider ) VALUES(:email, :provider)");
                        $statement->execute(['email' => $inputEmail, 'provider' => $provider]);

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

        //delete records from DB
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

            // These need to be checked, otherwise throws undefined index error
            if (isset($_SESSION["search"])) {
                $search = $_SESSION["search"];
            } if (isset($_SESSION["filter"])) {
                $filter = $_SESSION["filter"];
            } if (isset($_SESSION["order"])) {
                $order = $_SESSION["order"];
            } if (isset($_SESSION["direction"])) {
                $direction = $_SESSION["direction"];
            }

            // reset all filters on subscribers.php
            if (isset($filter) && $filter == "Reset") {

                unset($_SESSION["search"]);
                unset($_SESSION["filter"] );
                unset($_SESSION["order"]);
                unset($_SESSION["direction"]);

                header("Location: /subscribers.php");
                exit();
            }

            // case when all are set
            if (isset($search) && isset($filter) && isset($order) && isset($direction)) {
                
                $statement = $this->conn->prepare("select * from subscribers where provider = :filter and email like CONCAT('%', :search, '%') order by $order $direction");
                $statement->execute(["filter" => $filter, "search" => $search]);

            }
            // case when provider + order set
           else if (isset($filter) && isset($order) && isset($direction)) {

                $statement = $this->conn->prepare("select * from subscribers where provider = :filter order by $order $direction");
                $statement->execute(["filter" => $filter]);
                
            }
            // case when search + order set
            else if (isset($search) && isset($order) && isset($direction)) {

                $statement = $this->conn->prepare("select * from subscribers where email like CONCAT('%', :search, '%') order by $order $direction");
                $statement->execute([ "search" => $search]);
            }           

            // case when provider + search set
            else if (isset($search) && isset($filter)) {

                $statement = $this->conn->prepare("select * from subscribers where provider = :filter and email like CONCAT('%', :search, '%') order by date desc");
                $statement->execute(["filter" => $filter, "search" => $search]);

            // case when only search set
            } else if (isset($search)) {
                echo "got here";
                $statement = $this->conn->prepare("select * from subscribers where email like CONCAT('%', :search, '%') order by date desc");
                $statement->execute([ "search" => $search]);
            
            // case when only filter set (provider)
            } else if (isset($filter)) {

                $statement = $this->conn->prepare("select * from subscribers where provider = :filter order by date desc");
                $statement->execute(["filter" => $filter]);

            // case when just ordering is provided
            } else if (isset($order) && isset($direction)) {
                $statement = $this->conn->prepare("select * from subscribers order by $order $direction");
                $statement->execute();
            }

            $data = $statement->fetchAll();
            return $data;
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
            } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) { // - Invalid email is added - “Please provide a valid e-mail address”
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
