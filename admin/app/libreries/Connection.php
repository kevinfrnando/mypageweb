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
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => true,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
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
//
//    /**
//     * @param $sqlParameter
//     * @param $value
//     * @param null $type
//     *
//     * Vinculamos los parametros
//     *
//     */
//    public function bindInOut($sqlParameter, $value, $type = null){
//        if( is_null($type) ){
//            switch ( true ){
//                case is_int( $value );
//                    $type = PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT;
//                    break;
//                case is_bool( $value );
//                    $type = PDO::PARAM_BOOL|PDO::PARAM_INPUT_OUTPUT;
//                    break;
//                case is_null( $value );
//                    $type = PDO::PARAM_NULL|PDO::PARAM_INPUT_OUTPUT;
//                    break;
//                default :
//                    $type = PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT;
//                    break;
//            }
//        }
//
//        $this->stm->bindParam($sqlParameter, $value, $type);
//    }



    public function currentQuery($sql){
        $this->stm->execute();
        $this->stm->closeCursor();
        return current( $this->dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC));
    }

    /**
     * @return mixed
     * Ejecuta la consulta
     */

    public function execute(){
        try {
            return $this->stm->execute();

//            $this->disconect();
        }catch (PDOException $e){
            return [
                "code" => $e->getCode(),
                "message" => $e->getMessage()
            ];
        }

    }

    /**
     * Se obtienen todos los registros
     *
     */

    public function getAll(){
        $this->execute();

        $records = $this->stm->fetchALL(PDO::FETCH_OBJ);

        $this->stm->closeCursor();

        return $records;
    }


    public function getRecord(){
        $this->execute();
        $record = $this->stm->fetch(PDO::FETCH_OBJ);
        $this->stm->closeCursor();
        return $record;
    }


    public function rowCount(){
        $record =  $this->stm->rowCount();
        $this->stm->closeCursor();
        return $record;
    }

    public function disconect(){
        $this->stm = null;
        $this->dbh = null;
    }
}
