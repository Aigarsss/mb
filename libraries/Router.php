<?php

require "bootstrap.php";


class Router {

    protected $selectedController = "Pages";
    protected $selectedMethod = "index";
    protected $selectedParams = [];
   
    public function __construct() {
        $this->getRoute();
    }

    public function getRoute() {
        $url = $this->getUrl();

        if (isset($url[0])) {

            $contr = ucfirst($url[0]);

            if(file_exists("controllers/" . $contr . ".php")) {
                $this->selectedController = $contr;
            }
        }

        require "controllers/" . $this->selectedController . ".php";
        $this->selectedController = new $this->selectedController;
        unset($url[0]);

        if (isset($url[1])) {
            $meth = strtolower($url[1]);

            $this->selectedMethod = $meth;
            unset($url[1]);
        }

        if (method_exists($this->selectedController, $this->selectedMethod) ) {

            call_user_func_array([$this->selectedController, $this->selectedMethod], $this->selectedParams);
        } else {
            echo "no such page";
        }

    }


    public function getUrl() {
        if (isset($_GET['url'])) {

            $url = rtrim($_GET['url'], "/");
            return explode("/", $url);
        }

    }




}