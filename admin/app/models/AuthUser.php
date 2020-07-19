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
        $this->db->query("CALL sp_insert_user(?,?,?,?,?,?,?,?,?,?,?,?)");

        $this->db->bind(1, $data["first_name"] );
        $this->db->bind(2, $data["last_name"] );
        $this->db->bind(3, $data["first_name"]. " " . $data["last_name"]);
        $this->db->bind(4, $data["age"]);
        $this->db->bind(5, $data["gender"]);
        $this->db->bind(6, $data["user"] );
        $this->db->bind(7, $data["email"] );
        $this->db->bind(8, $data["password"] );
        $this->db->bind(9, date("Y-m-d H:i:s"));
        $this->db->bind(10, $data["user_id"]);
        $this->db->bind(11, $data["status"]);
        $this->db->bind(12, $data["permission"]);

        return $this->db->executeQuery() ?? false;

    }

    public function getUser($id){
        $this->db->query("CALL sp_find_auth_user(?)");
        $this->db->bind(1, $id);
        return $this->db->getRecord();
    }

    public function getUsersIn($ids){
        $this->db->query("CALL sp_get_auth_users_in(:ids)");
        $this->db->bind(":ids", $ids);
        return $this->db->getAll();
    }


    public function update($data){
        $this->db->query("CALL sp_update_auth_user(?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $this->db->bind(1, $data["id"]);
        $this->db->bind(2, $data["first_name"] );
        $this->db->bind(3, $data["last_name"] );
        $this->db->bind(4, $data["first_name"]. " " . $data["last_name"]);
        $this->db->bind(5, $data["age"] );
        $this->db->bind(6, $data["gender"] );
        $this->db->bind(7, $data["user"] );
        $this->db->bind(8, $data["email"] );
        $this->db->bind(9, $data["password"] );
        $this->db->bind(10, date("Y-m-d H:i:s"));
        $this->db->bind(11, $data["user_id"]);
        $this->db->bind(12, $data["status"]);
        $this->db->bind(13, $data["permission"]);
        return $this->db->executeQuery() ?? false;

    }

    public function delete($data){
        $this->db->query("call sp_delete_auth_user(?,?,?)");
        $this->db->bind(1,$data["id"]);
        $this->db->bind(2,date("Y-m-d H:i:s"));
        $this->db->bind(3,$data["deleted_by"]);
        return $this->db->executeQuery() ?? false;
    }


    public function countRows(){
        $this->db->query(" CALL sp_count_auth_users()");
        return $this->db->getRecord();
    }



}