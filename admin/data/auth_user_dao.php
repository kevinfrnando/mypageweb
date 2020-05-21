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
            $query = "SELECT * FROM auth_user WHERE email = :email AND password = :password";

            self::get_conection();
            $result = self::$conx->prepare($query);
            $result->bindValue(":email", $user->getEmail());
            $result->bindValue(":password", $user->getPassword());

            $result->execute();

            if( $result->rowCount() > 0){
                $row = $result->fetch() ;
                if( $row["email"] == $user->getEmail() && $row["password"] == $user->getPassword()){
                    return true;
                }
            }else{
                return false;
            }

        }catch (Exception $e){

        }
    }

    /**
     *
     * Obtener User
     * @param $user
     * @return auth_user
     */

    public static function getUser($user){
        try {
            $query = "SELECT 
                    id,
                    version,
                    first_name,
                    last_name,
                    full_name,
                    user,
                    email,
                    last_login,
                    last_ip,
                    created_on,
                    created_by,
                    updated_on,
                    updated_by,
                    deleted_on,
                    updated_on,
                    deleted_by,
                    status_id, permissions_id FROM auth_user WHERE email = :email AND password = :password";

            self::get_conection();
            $result = self::$conx->prepare($query);
            $result->bindValue(":email", $user->getEmail());
            $result->bindValue(":password", $user->getPassword());

            $result->execute();

            $row = $result->fetch();

            $user = new auth_user();
            $user->setId($row["id"]);
            $user->setVersion($row["version"]);
            $user->setFirstName($row["first_name"]);
            $user->setLastName($row["last_name"]);
            $user->setFullName($row["full_name"]);
            $user->setUser($row["user"]);
            $user->setEmail($row["email"]);
            $user->setLastLogin($row["last_login"]);
            $user->setLastIp($row["last_ip"]);
            $user->setCreatedOn($row["created_on"]);
            $user->setCreatedBy($row["created_by"]);
            $user->setUpdatedBy($row["updated_by"]);
            $user->setDeleteOn($row["deleted_on"]);
            $user->setDeletedBy($row["deleted_by"]);
            $user->setStatusId($row["status_id"]);
            $user->setPermissionsId($row["permissions_id"]);

            return $user;
        }catch (Exception $e){

        }
    }


    /**
     * Metodo para editar usuario
     * @param $id
     * @return auth_user
     *
     */
    public static function getUserById($id){
        try {
            $query = "SELECT 
                    id,
                    version,
                    first_name,
                    last_name,
                    full_name,
                    user,
                    email,
                    last_login,
                    last_ip,
                    created_on,
                    created_by,
                    updated_on,
                    updated_by,
                    deleted_on,
                    updated_on,
                    deleted_by,
                    status_id, permissions_id FROM auth_user WHERE id = :id";

            self::get_conection();
            $result = self::$conx->prepare($query);
            $result->bindValue(":id", $id);

            $result->execute();

            $row = $result->fetch();
            $user = new auth_user();
            $user->setId($row["id"]);
            $user->setVersion($row["version"]);
            $user->setFirstName($row["first_name"]);
            $user->setLastName($row["last_name"]);
            $user->setFullName($row["full_name"]);
            $user->setUser($row["user"]);
            $user->setEmail($row["email"]);
            $user->setLastLogin($row["last_login"]);
            $user->setLastIp($row["last_ip"]);
            $user->setCreatedOn($row["created_on"]);
            $user->setCreatedBy($row["created_by"]);
            $user->setUpdatedBy($row["updated_by"]);
            $user->setDeleteOn($row["deleted_on"]);
            $user->setDeletedBy($row["deleted_by"]);
            $user->setStatusId($row["status_id"]);
            $user->setPermissionsId($row["permissions_id"]);

            return $user;
        }catch (Exception $e){

        }
    }

    /**
     * metodo para registrar Usuario
     * @param $user
     * @return bool
     */
    public static function registerUser($user){
        try {

            if( is_null($user->getId())) {
                $query = "INSERT INTO auth_user (first_name, last_name, full_name, user, email, password, created_on, created_by, status_id, permissions_id)
                VALUES( :first_name, :last_name, :full_name, :user, :email, :password, :created_on, :created_by, :status_id, :permissions_id )";
            }else{
                $query = "UPDATE auth_user SET
                first_name = :first_name, 
                last_name = :last_name, 
                full_name = :full_name, 
                user = :user, 
                email = :email, 
                password = :password, 
                updated_on = :updated_on, 
                updated_by = :updated_by, 
                status_id = :status_id,
                permissions_id = :permissions_id WHERE id = :id";
            }

            self::get_conection();
            $result = self::$conx->prepare($query);
            $result->bindValue(":first_name", $user->getFirstName());
            $result->bindValue(":last_name", $user->getLastName());
            $result->bindValue(":full_name", $user->getFullName());
            $result->bindValue(":user", $user->getUser());
            $result->bindValue(":email", $user->getEmail());
            $result->bindValue(":password", $user->getPassword());
            $result->bindValue(":status_id", $user->getStatusId());
            $result->bindValue(":permissions_id", $user->getPermissionsId());
            if( !is_null($user->getId())){
                $result->bindValue(":id", $user->getId());
                $result->bindValue(":updated_on", $user->getCreatedOn());
                $result->bindValue(":updated_by", $user->getCreatedBy());

            }else{
                $result->bindValue(":created_by", $user->getCreatedOn());
                $result->bindValue(":created_on", $user->getCreatedOn());
            }

            if( $result->execute() ){
                return true;
            }


            return false;
        }catch (Exception $e){

        }
    }


    /**
     * Obtengo todos los usuarios
     * @return mixed
     *
     */
    public static function getAllUser(){
        try {
            $query = "SELECT 
                    id,
                    version,
                    first_name,
                    last_name,
                    full_name,
                    user,
                    email,
                    last_login,
                    last_ip,
                    created_on,
                    created_by,
                    updated_on,
                    updated_by,
                    deleted_on,
                    updated_on,
                    deleted_by,
                    status_id, permissions_id FROM auth_user";

            self::get_conection();
            $result = self::$conx->prepare($query);

            $result->execute();

            $rows = $result->fetchAll();


            return $rows;
        }catch (Exception $e){

        }
    }



}