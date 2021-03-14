<?php


class Database {
    
    private $db_name = DB_NAME;
    private $db_username = DB_USER;
    private $db_server = DB_SERVER;
    private $db_password = DB_PASSWORD;

    private $dsn;
    private $dbh;
    private $error;



    public function __construct() {

        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        $this->dsn = "mysql:dbname=" . $this->db_name . ";host=" . $this->db_server;

        try {
            $this->dbh = new PDO($this->dsn, $this->db_username, $this->db_password, $options);
            echo "test";
        } catch(PDOExcepton $e) {
            $this->error = $e->getMessage();
            echo "connection failed: " . $this->error;
        }

    }
    
}