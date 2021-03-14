<?php

class Controller {


    public function view($view, $data = []) {

        if(file_exists("views/" . $view . ".php")) {
            require "views/" . $view . ".php";
        } else {
            echo "no such view exists";
        }

    }
}