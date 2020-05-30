<?php

class conection{

    /**
     * @return PDO
     * return conection
     */
    public static function conect(){
        try {
            $cn = new PDO("mysql:host=localhost;dbname=karikum", "root", "");

            return $cn;

        }catch (PDOException $e){
            die($e->getMessage());
        }

    }
}

conection::conect();

