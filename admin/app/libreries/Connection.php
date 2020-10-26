<?php


class Connection
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbName = DB_NAME;
    private $dbh;
    private $error;


    public function connect(){

        $stringConnection = "mysql:host=".$this->host.";dbname=".$this->dbName;
        $options = array(
            PDO::ATTR_PERSISTENT => TRUE,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => TRUE,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
        try {
            $this->dbh = new PDO( $stringConnection , $this->user, $this->pass, $options);
            $this->dbh->exec("set names utf8");
        }catch ( PDOException $e ){
            $this->error = $e->getMessage();
        }

        return $this->dbh;
    }

}