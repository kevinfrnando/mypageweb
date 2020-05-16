<?php
include '../data/auth_user_dao.php';

class auth_user_controller{

    public static function login($usuario, $password){
        $obj = new auth_user();
        $obj->setUser( $usuario );
        $obj->setPassword( $password );

        return auth_user_dao::login( $obj );
    }

}
