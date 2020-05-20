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

    public static function registerUser( $id, $firstName, $lastName, $fullName, $user, $email, $password, $createdBy, $createdOn, $permissionsId, $statusId){

        $obj = new auth_user();
        $obj->setLastName( $lastName);
        $obj->setFirstName( $firstName);
        $obj->setFullName( $fullName );
        $obj->setEmail( $email );
        $obj->setPassword( $password );
        $obj->setCreatedOn( $createdOn);
        $obj->setUser( $user );
        $obj->setCreatedBy( $createdBy);
        $obj->setStatusId( $statusId );
        $obj->setPermissionsId( $permissionsId );
        if( !is_null($id)){
            $obj->setId( $id );
        }

        return auth_user_dao::registerUser( $obj );
    }


    public static function getAllUser(){
        return  auth_user_dao::getAllUser();
    }

    public static function getUserById($id){
        return auth_user_dao::getUserById($id);
    }
}
