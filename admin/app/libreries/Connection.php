<?php

class Connection{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbName = DB_NAME;

    private $dbh; //dataBaseHandle
    private $stm;
    private $error;

    public function __construct(){
        $stringConnection = "mysql:host=".$this->host.";dbname=".$this->dbName;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        try {
            $this->dbh = new PDO( $stringConnection , $this->user, $this->pass, $options);
            $this->dbh->exec("set names utf8");
        }catch ( PDOException $e ){
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    /**
     * @param $sql
     * Se prepara la consulta
     */

    public function query($sql){
        $this->stm = $this->dbh->prepare($sql);
    }

    /**
     * @param $sqlParameter
     * @param $value
     * @param null $type
     *
     * Vinculamos los parametros
     *
     */
    public function bind($sqlParameter, $value, $type = null){
        if( is_null($type) ){
            switch ( true ){
                case is_int( $value );
                $type = PDO::PARAM_INT;
                break;
                case is_bool( $value );
                $type = PDO::PARAM_BOOL;
                break;
                case is_null( $value );
                $type = PDO::PARAM_NULL;
                break;
                default :
                    $type = PDO::PARAM_STR;
                break;
            }
        }

        $this->stm->bindValue($sqlParameter, $value, $type);
    }

    /**
     * @return mixed
     * Ejecuta la consulta
     */

    public function execute(){
        return $this->stm->execute();

    }

    /**
     * Se obtienen todos los registros
     *
     */

    public function getAll(){
        $this->execute();
        return $this->stm->fetchALL(PDO::FETCH_OBJ);

    }


    public function getRecord(){
        $this->execute();
        return $this->stm->fetch(PDO::FETCH_OBJ);
    }


    public function rowCount(){
        return $this->stm->rowCount();
    }
}
