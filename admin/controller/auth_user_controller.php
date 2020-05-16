<?php
include '../data/auth_user_dao.php';

class auth_user_controller{

    public static function login($email, $password){
        $obj = new auth_user();
        $obj->setEmail( $email );
        $obj->setPassword( $password );

        return auth_user_dao::login( $obj );
    }

    public static function getUser($email, $password){
        $obj = new auth_user();
        $obj->setEmail( $email );
        $obj->setPassword( $password );

        return auth_user_dao::getUser( $obj );
    }

}
