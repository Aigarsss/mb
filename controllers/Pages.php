<?php


class Pages extends Controller {


    public function index() {

        $data = [
            "test" => "test data"
        ];
        
        return $this->view("pages/index", $data);
    }

    public function subscribers() {

        $data = [
            "test" => "test data"
        ];
        
        return $this->view("pages/subscribers", $data);
    }
}