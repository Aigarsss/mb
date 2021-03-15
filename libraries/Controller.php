<?php

class Controller {

    public $connection;

    public function __construct() {
        $this->connection = new Database();
    }


    public function view($view, $data = []) {

        if(file_exists("views/" . $view . ".php")) {
            require "views/" . $view . ".php";
        } else {
            echo "no such view exists";
        }

    }

    public function validateEmail($email, $terms){

        $errors = array();

        // - Provided email is ending with .co - “We are not accepting subscriptions from Colombia emails”.
        if (preg_match('/.co$/', $email)) {
            $errors["co"] = "We are not accepting subscriptions from Colombia emails";
        }

        // - No email address is provided - “Email address is required”
        if (!isset($email) || empty($email)) {
            $errors["email"] = "Missing email";
        } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) { // - Invalid email is added - “Please provide a valid e-mail address”
                $errors["invalidEmail"] = "Please provide a valid e-mail address";
                }

        // - The checkbox is not marked - “You must accept the terms and conditions”
        if (!$terms) {
            $errors["checkbox"] = "You must accept the terms and conditions";
        }

        return $errors;
    }
}