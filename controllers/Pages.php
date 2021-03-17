<?php


class Pages extends Controller {


    public function index() {

        
        $data = [
            "errors" => ""
        ];
        

        if (isset($_POST['submit'])) {

            $email = $_POST["email"];
            $terms = isset($_POST["terms"]) ? true : false;

            $errors = $this->validateEmail($email,$terms);
            // - Return the errors
            if (count($errors) > 0) {
                $data['errors'] = $errors;

                return $this->view("pages/index", $data);
            }

            
            if ($email && $terms) {

                $domain = substr($email, strpos($email, '@') + 1);
                $provider = substr($email, strpos($email, '@') + 1, strpos($domain, '.'));

                $this->connection->insertEmail($email, $provider);

                header("Location: /pages/success"); // check??
                exit();

            }

        }

        return $this->view("pages/index", $data);
    }



    public function subscribers() {

        $data = [
            /// problem, appliedFilters get reset each time
            "appliedFilters" => [],
            "rows" => []
        ];

        // problem - this resets existing values. FIX
        // $search = isset($_GET['search']) ? $_GET['search'] : false;
        // $filter = isset($_GET['filter']) ? $_GET['filter'] : false;
        // $order = isset($_GET['orderBy']) ? $_GET['orderBy'] : false;
        // $direction = isset($_GET['direction']) ? $_GET['direction'] : false;


        if (isset($_GET['search'])) {
            $_SESSION["search"] = $_GET['search'];
        }
        if (isset($_GET['filter'])) {
            $_SESSION["filter"] = $_GET['filter'];
        }
        if (isset($_GET['orderBy'])) {
            $_SESSION["order"] = $_GET['orderBy'];
        }
        if (isset($_GET['direction'])) {
            $_SESSION["direction"] = $_GET['direction'];
        }

        // reset session on filter "Reset"
        if (isset($_SESSION["filter"]) && $_SESSION["filter"] == "Reset") {
            unset($_SESSION["search"]);
            unset($_SESSION["filter"] );
            unset($_SESSION["order"]);
            unset($_SESSION["direction"]);

            header("Location: subscribers");
            exit();
        }

        echo var_dump($_SESSION);

        
        //// filtering

        // set params, that will be used for filtering and running queries
        $params = [];


        if (($_SESSION["search"]) && ($_SESSION["filter"]) && isset($_SESSION["direction"]) && isset($_SESSION["order"])) {

            // case when all are set
            $order = $_SESSION["order"];
            $direction = $_SESSION["direction"];
            $sql = "select * from subscribers where provider = :filter and email like CONCAT('%', :search, '%') order by $order $direction";
            $params[":filter"] = $_SESSION["filter"];
            $params[":search"] = $_SESSION["search"];
            $data['rows'] = $this->connection->filterProvider($sql, $params);


        } else if (($_SESSION["filter"]) && isset($_SESSION["direction"]) && isset($_SESSION["order"])) {

            // case when provider + order set
            $order = $_SESSION["order"];
            $direction = $_SESSION["direction"];
            $sql = "select * from subscribers where provider = :filter order by $order $direction";
            $params[":filter"] = $_SESSION["filter"];
            $data['rows'] = $this->connection->filterProvider($sql, $params);

        } else if (isset($_SESSION["search"]) && isset($_SESSION["direction"]) && isset($_SESSION["order"])) {
            
            // case when search + order set
            $order = $_SESSION["order"];
            $direction = $_SESSION["direction"];
            $sql = "select * from subscribers where email like CONCAT('%', :search, '%') order by $order $direction";
            $params[":search"] = $_SESSION["search"];
            $data['rows'] = $this->connection->filterProvider($sql, $params);

        } else if (isset($_SESSION["search"]) && isset($_SESSION["filter"])) {
 
            // case when provider + search set
            $sql = "select * from subscribers where provider = :filter and email like CONCAT('%', :search, '%') order by date desc";
            $params[":search"] = $_SESSION["search"];
            $params[":filter"] = $_SESSION["filter"];
            $data['rows'] = $this->connection->filterProvider($sql, $params);

        } else if (isset($_SESSION["search"])) {

            // case when only search set
            $sql = "select * from subscribers where email like CONCAT('%', :search, '%') order by date desc";
            $params[":search"] = $_SESSION["search"];
            $data['rows'] = $this->connection->filterProvider($sql, $params);

        } else if (isset($_SESSION["filter"]) && $_SESSION["filter"] != "Reset") {


            // case when only filter set (provider) and it is not "Reset"
            $sql = "select * from subscribers where provider = :filter order by date desc";
            $params[":filter"] = $_SESSION["filter"];
            $data['rows'] = $this->connection->filterProvider($sql, $params);

        } else if (isset($_SESSION["order"]) && isset($_SESSION["direction"])) {

            // case when just ordering is provided
            $order = $_SESSION["order"];
            $direction = $_SESSION["direction"];

            $sql = "select * from subscribers order by $order $direction";
            $data['rows'] = $this->connection->filterProvider($sql, $params);

        } else {
            // all other cases 
            $data['rows'] = $this->connection->getAllSubs();

        }


        //// delete entry logic

        if (isset($_GET['deleteId'])) {
            $this->connection->deleteSub($_GET['deleteId']);

            // so that reload happens after delete
            header("Location: subscribers");
            exit();
        }

        // line to show filters applied
        $data["appliedFilters"] = $_SESSION;

        return $this->view("pages/subscribers", $data);
    }


    public function success() {

        $data = [
        ];
        
        return $this->view("pages/success", $data);
    }
}