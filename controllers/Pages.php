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
            $search = $_SESSION["search"];
        }
        if (isset($_GET['filter'])) {
            $_SESSION["filter"] = $_GET['filter'];
            $filter = $_SESSION["filter"];
        }
        if (isset($_GET['orderBy'])) {
            $_SESSION["order"] = $_GET['orderBy'];
            $order = $_SESSION["order"];
        }
        if (isset($_GET['direction'])) {
            $_SESSION["direction"] = $_GET['direction'];
            $direction = $_SESSION["direction"];
        }

        // reset session on filter "Reset"
        if (isset($filter) && $filter == "Reset") {
            unset($_SESSION["search"]);
            unset($_SESSION["filter"] );
            unset($_SESSION["order"]);
            unset($_SESSION["direction"]);

            header("Location: subscribers");
            exit();
        }

        echo var_dump($_SESSION);

        
        //// filtering

        // set params, that will be used for filtering and runnin queries
        $params = [];


        if (isset($filter) && isset($direction) && isset($order) && isset($search)) {

            // case when all are set
            $sql = "select * from subscribers where provider = :filter and email like CONCAT('%', :search, '%') order by $ord $dir";
            $params[":filter"] = $filter;
            $params[":search"] = $search;
            $data['rows'] = $this->connection->filterProvider($sql, $params);


        } else if (isset($filter) && isset($direction) && isset($order)) {

            // case when provider + order set
            $sql = "select * from subscribers where provider = :filter order by $ord $dir";
            $params[":filter"] = $filter;
            $data['rows'] = $this->connection->filterProvider($sql, $params);

        } else if (isset($search) && isset($direction) && isset($order)) {
            
            // case when search + order set
            $sql = "select * from subscribers where email like CONCAT('%', :search, '%') order by $ord $dir";
            $params[":search"] = $search;
            $data['rows'] = $this->connection->filterProvider($sql, $params);

        } else if (isset($search) && isset($filter)) {

            // case when provider + search set
            $sql = "select * from subscribers where provider = :filter and email like CONCAT('%', :search, '%') order by date desc";
            $params[":search"] = $search;
            $params[":filter"] = $filter;
            $data['rows'] = $this->connection->filterProvider($sql, $params);

        } else if (isset($search)) {

            // case when only search set
            $sql = "select * from subscribers where email like CONCAT('%', :search, '%') order by date desc";
            $params[":search"] = $search;
            $data['rows'] = $this->connection->filterProvider($sql, $params);

        } else if (isset($filter) && $filter != "Reset") {

            // case when only filter set (provider) and it is not "Reset"
            $sql = "select * from subscribers where provider = :filter order by date desc";
            $params[":filter"] = $filter;
            $data['rows'] = $this->connection->filterProvider($sql, $params);

        } else if (isset($order) && isset($direction)) {

            // case when just ordering is provided

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