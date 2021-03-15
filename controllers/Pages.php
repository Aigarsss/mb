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
            "appliedFilters" => [],
            "rows" => []
        ];

        if (isset($_GET['search'])) {
            $_SESSION["search"] = $_GET['search'];
            $data['appliedFilters']['search'] = $_SESSION["search"];
        } if (isset($_GET['filter'])) {
            $_SESSION["filter"] = $_GET['filter'];
            $data['appliedFilters']['filter'] = $_SESSION["filter"];
        } if (isset($_GET['orderBy'])) {
            $_SESSION["order"] = $_GET['orderBy'];
            $data['appliedFilters']['orderBy'] = $_SESSION["order"];
        } if (isset($_GET['direction'])) {
            $_SESSION["direction"] = $_GET['direction'];
            $data['appliedFilters']['direction'] = $_SESSION["direction"];
        }

        if (isset($_SESSION["filter"]) && $_SESSION["filter"] == "Reset") {
            unset($_SESSION["search"]);
            unset($_SESSION["filter"] );
            unset($_SESSION["order"]);
            unset($_SESSION["direction"]);
        }

        $data['rows'] = $this->connection->getAllSubs(); // to do, this is for everyhting
        // filtering

        // if (isset($_GET['filter'])) {
        //     $rows = $model->filterProvider();
        // } else if (isset($_GET['orderBy']) && isset($_GET['direction'])){
        //     $rows = $model->filterProvider();
        // } else if (isset($_GET['search'])){
        //     $rows = $model->filterProvider();
        // } else {
        //     $rows = $page->connection->getAllSubs();;
        // }


        // delete logic

        if (isset($_GET['deleteId'])) {
            $this->connection->deleteSub($_GET['deleteId']);
        }


        echo var_dump($_SESSION);

        return $this->view("pages/subscribers", $data);
    }


    public function success() {

        $data = [
        ];
        
        return $this->view("pages/success", $data);
    }
}