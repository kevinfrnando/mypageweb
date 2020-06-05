<?php

class AuthUser{


    public function __construct(){
        $this->db = new Connection();
    }

    public function getAll(){
        $this->db->query("select * from auth_user");

        $rows = $this->db->getAll();

        return $rows;
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
        $this->db->bind(":created_on", date('d-m-Y H:i:s'));
        $this->db->bind(":created_by", $data["created_by"]);
        $this->db->bind(":status_id", 1);
        $this->db->bind(":permissions_id", 1);

        return $this->db->execute() ?? false;

    }

    public function getUser($id){
        $this->db->query("select * from auth_user where id = :id");
        $this->db->bind(":id", $id);
        return $this->db->getRecord();
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
        $this->db->bind(":updated_on", date('d-m-Y H:i:s'));
        $this->db->bind(":updated_by", 1);
        $this->db->bind(":status_id", 1);
        $this->db->bind(":permissions_id", 1);
        $this->db->bind(":id", $data["id"]);

        return $this->db->execute() ?? false;

    }

    public function delete($id){
        $this->db->query("DELETE FROM auth_user where id = :id");
        $this->db->bind(":id", $id);
        return $this->db->execute() ?? false;
    }




}