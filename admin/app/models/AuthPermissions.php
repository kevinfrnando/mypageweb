<?php


class AuthPermissions
{
    public function __construct(){
        $this->db = new Connection();
    }

    public function getData( $start, $limit ){
        $this->db->query( "CALL sp_get_auth_permissions( :start, :limit)" );
        $this->db->bind( ":start" , $start );
        $this->db->bind( ":limit" , $limit );
        return $this->db->getAll();
    }

    public function countRows(){
        $this->db->query("CALL sp_count_auth_permisions()");
        return $this->db->getRecord();
    }

    public function getPermission($id){
        $this->db->query("CALL sp_find_auth_permissions(:id)");
        $this->db->bind(":id", $id);
        return $this->db->getRecord();
    }

    public function insert($data){
        $this->db->query("call sp_insert_auth_permissions(?,?,?,?,?,?,?,?)");
        $this->db->bind(1,$data["code"]);
        $this->db->bind(2,$data["description"]);
        $this->db->bind(3,$data["read"]);
        $this->db->bind(4,$data["create"]);
        $this->db->bind(5,$data["delete"]);
        $this->db->bind(6,$data["update"]);
        $this->db->bind(7,$data["user_id"]);
        $this->db->bind(8,date("Y-m-d H:i:s"));
        return $this->db->execute();
    }

    public function update($data){
        $this->db->query("call sp_update_auth_permissions(?,?,?,?,?,?,?,?,?)");
        $this->db->bind(1,$data["id"]);
        $this->db->bind(2,$data["code"]);
        $this->db->bind(3,$data["description"]);
        $this->db->bind(4,$data["read"]);
        $this->db->bind(5,$data["create"]);
        $this->db->bind(6,$data["delete"]);
        $this->db->bind(7,$data["update"]);
        $this->db->bind(8,$data["user_id"]);
        $this->db->bind(9,date("Y-m-d H:i:s"));
        return $this->db->execute();

    }

    public function delete( $data ){
        $this->db->query("call sp_delete_auth_permissions(?,?,?)");
        $this->db->bind(1,$data["id"]);
        $this->db->bind(2,date("Y-m-d H:i:s"));
        $this->db->bind(3,$data["deleted_by"]);
        return $this->db->execute() ?? false;
    }
}