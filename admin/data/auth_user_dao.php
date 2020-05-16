<?php
include 'conection.php';
include '../model/auth_user.php';

class auth_user_dao extends conection {
    protected static $conx;

    public static function get_conection(){
        self::$conx = conection::conect();
    }
    private static function disconect(){
        self::$conx = null;
    }

    /**
     * @param $user
     * @return boolean
     */
    public static function login($user){
        try {
            $query = "SELECT * FROM auth_user WHERE user = :user AND password = :password";

            self::get_conection();
            $result = self::$conx->prepare($query);
            $result->bindValue(":user", $user->getUser());
            $result->bindValue(":password", $user->getPassword());

            $result->execute();

            if( $result->rowCount() > 0){
                $row = $result->fetch() ;
                if( $row["user"] == $user->getUser() && $row["password"] == $user->getPassword()){
                    return true;
                }
            }else{
                return false;
            }

        }catch (Exception $e){

        }
    }

}