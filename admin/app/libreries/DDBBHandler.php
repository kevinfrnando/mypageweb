<?php

class DDBBHandler{

    private $dbh; //dataBaseHandle
    private $stm;


    public function __construct( $con = null ){
        $this->dbh = $con != null ? $con : Core::getConnection();
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

    public function currentQuery($sql){
        $this->stm->execute();
        $this->stm->closeCursor();
        return current( $this->dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC));
    }

    /**
     * @return mixed
     * Ejecuta la consulta
     */

    public function executeQuery(){
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
        $this->executeQuery();

        $records = $this->stm->fetchALL(PDO::FETCH_OBJ);

        $this->stm->closeCursor();

        return $records;
    }


    public function getRecord(){
        $this->executeQuery();
        $record = $this->stm->fetch(PDO::FETCH_OBJ);
        $this->stm->closeCursor();
        return $record;
    }


    public function rowCount(){
        $record =  $this->stm->rowCount();
        $this->stm->closeCursor();
        return $record;
    }

    public function getLastInsert(){
        $this->query("SELECT LAST_INSERT_ID() as id");
        $this->executeQuery();
        return $this->stm->fetch( PDO::FETCH_OBJ );
    }

    public function disconect(){
        $this->stm = null;
        $this->dbh = null;
    }
}
