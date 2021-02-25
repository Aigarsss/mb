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

            // ["terms"] = "checked"

            if (isset($_POST['submit'])) {

                if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['terms'])) {
                
                    $inputEmail = $_POST['email'];
                    $domain = substr($inputEmail, strpos($inputEmail, '@') + 1);
                    $provider = substr($inputEmail, strpos($inputEmail, '@') + 1, strpos($domain, '.'));

                    try {

                        $statement = $this->conn->prepare("insert into subscribers(email, provider ) VALUES(:email, :provider)");
                        $statement->execute(['email' => $inputEmail, 'provider' => $provider]);
                        echo 'Subscriber Added';


                        // var_dump($_POST);
                        header("Location: /success.php");
                        exit();
        
                    } catch (Exception $e) {
                        die($e->getMessage());
                    }

                } else {
                    //echo "something went wrong";
                }

            } else {
                //echo "something went wrong2";
            }

    // }
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

        public function filterProvider(){

            if (isset($_GET['filter'])) {
                $filter = $_GET['filter'];

                if ($filter == "" && isset($_GET['search'])) {
                    
                    $searchTerm = $_GET['search'];

                    $statement = $this->conn->prepare("select * from subscribers where email like CONCAT('%', :searchTerm, '%')");
                    $statement->execute(["searchTerm" => $searchTerm]);

                } else if ($filter == "All") {
                    $statement = $this->conn->prepare("select * from subscribers");
                    $statement->execute();
                } else {
                    $statement = $this->conn->prepare("select * from subscribers where provider = :filter");
                    $statement->execute(["filter" => $filter]);
                }

                $data = $statement->fetchAll();
    
                return $data;

            }

        }

}

?>
