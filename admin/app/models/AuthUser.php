<?php

class AuthUser{


    public function __construct(){
        $this->db = new Connection();
    }

    public function getData( $start, $limit){
        $this->db->query("CALL sp_get_auth_users( :start, :limit)");
        $this->db->bind( ":start" , $start );
        $this->db->bind( ":limit" , $limit );
        return $this->db->getAll();
    }

    public function insert($data){
        $this->db->query("INSERT INTO auth_user (first_name, last_name, full_name, user, email, password, created_on, created_by, status_id, permissions_id)
                VALUES( :first_name, :last_name, :full_name, :user, :email, :password, :created_on, :created_by, :status_id, :permissions_id )");

        $this->db->bind(":first_name", $data["first_name"] );
        $this->db->bind(":last_name", $data["last_name"] );
        $this->db->bind(":full_name", $data["first_name"]. " " . $data["last_name"]);
        $this->db->bind(":user", $data["user"] );
        $this->db->bind(":email", $data["email"] );
        $this->db->bind(":password", $data["password"] );
        $this->db->bind(":created_on", date("Y-m-d H:i:s"));
        $this->db->bind(":created_by", $data["userd_id"]);
        $this->db->bind(":status_id", $data["status"]);
        $this->db->bind(":permissions_id", $data["permission"]);

        return $this->db->execute() ?? false;

    }

    public function getUser($id){
        $this->db->query("select * from auth_user where id = :id");
        $this->db->bind(":id", $id);
        return $this->db->getRecord();
    }

    public function getUsersIn($ids){
        $this->db->query("CALL sp_get_auth_users_in(:ids)");
        $this->db->bind(":ids", $ids);
        return $this->db->getAll();
    }


    public function update($data){
        $this->db->query("UPDATE auth_user SET
                first_name = :first_name, 
                last_name = :last_name, 
                full_name = :full_name, 
                user = :user, 
                email = :email, 
                password = :password, 
                updated_on = :updated_on, 
                updated_by = :updated_by, 
                status_id = :status_id,
                permissions_id = :permissions_id WHERE id = :id");

        $this->db->bind(":first_name", $data["first_name"] );
        $this->db->bind(":last_name", $data["last_name"] );
        $this->db->bind(":full_name", $data["first_name"]. " " . $data["last_name"]);
        $this->db->bind(":user", $data["user"] );
        $this->db->bind(":email", $data["email"] );
        $this->db->bind(":password", $data["password"] );
        $this->db->bind(":updated_on", date("Y-m-d H:i:s"));
        $this->db->bind(":updated_by", $data["userd_id"]);
        $this->db->bind(":status_id", $data["status"]);
        $this->db->bind(":permissions_id", $data["permission"]);
        $this->db->bind(":id", $data["id"]);

        return $this->db->execute() ?? false;

    }

    public function delete($data){
        $this->db->query("call sp_delete_auth_user(?,?,?)");
        $this->db->bind(1,$data["id"]);
        $this->db->bind(2,date("Y-m-d H:i:s"));
        $this->db->bind(3,$data["deleted_by"]);
        return $this->db->execute() ?? false;
    }


    public function countRows(){
        $this->db->query(" CALL sp_count_auth_users()");
        return $this->db->getRecord();
    }



}