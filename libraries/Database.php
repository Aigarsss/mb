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
        } catch(PDOExcepton $e) {
            $this->error = $e->getMessage();
            echo "connection failed: " . $this->error;
        }
    }

    public function insertEmail($email, $provider) {
        $statement = $this->dbh->prepare("insert into subscribers(email, provider) VALUES(:email, :provider)");
        $statement->execute(['email' => $email, 'provider' => $provider]);
    }

    public function getAllSubs() {
        $statement = $this->dbh->prepare("SELECT * FROM SUBSCRIBERS order by date desc");
        $statement->execute();
        $data = $statement->fetchAll();
        return $data;
    }

    public function deleteSub($id) {
        $statement = $this->dbh->prepare("DELETE FROM SUBSCRIBERS where id = :id");
        $statement->execute(['id' => $id]);
    }

    public function getProviders() {
        $statement = $this->dbh->prepare("select distinct(provider) from subscribers");
        $statement->execute();
        $data = $statement->fetchAll();
        return $data;
    }

    public function filterProvider($sql, $bind = []) {

        $statement = $this->dbh->prepare($sql);
        $statement->execute($bind);
    }
    
}