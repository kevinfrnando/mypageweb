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

    public function getAll(){
        $this->db->query("CALL sp_get_all_auth_permissions");
        return $this->db->getAll();
    }

    public function countRows(){
        $this->db->query("CALL sp_count_auth_permisions()");
        return $this->db->getRecord();
    }

    public function getPermissionsIn($ids){
        $this->db->query("CALL sp_get_auth_permissions_in(:ids)");
        $this->db->bind(":ids", $ids);
        return $this->db->getAll();
    }

    public function getPermission($id){
        $this->db->query("CALL sp_find_auth_permissions(:id)");
        $this->db->bind(":id", $id);
        return $this->db->getRecord();
    }


    public function insert($data){
        $this->db->query("call sp_insert_auth_permissions(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $this->db->bind(1,$data["code"]);
        $this->db->bind(2,$data["description"]);
        $this->db->bind(3,$data["can_read"]);
        $this->db->bind(4,$data["can_create"]);
        $this->db->bind(5,$data["can_delete"]);
        $this->db->bind(6,$data["can_update"]);
        $this->db->bind(7,$data["dashboard_menu"]);
        $this->db->bind(8,$data["profile_menu"]);
        $this->db->bind(9,$data["formation_menu"]);
        $this->db->bind(10,$data["about_menu"]);
        $this->db->bind(11,$data["users_menu"]);
        $this->db->bind(12,$data["components_menu"]);
        $this->db->bind(13,$data["status_id"]);
        $this->db->bind(14,$data["user_id"]);
        $this->db->bind(15,date("Y-m-d H:i:s"));
        return $this->db->executeQuery();
    }

    public function update($data){
        $this->db->query("call sp_update_auth_permissions(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $this->db->bind(1,$data["id"]);
        $this->db->bind(2,$data["code"]);
        $this->db->bind(3,$data["description"]);
        $this->db->bind(4,$data["can_read"]);
        $this->db->bind(5,$data["can_create"]);
        $this->db->bind(6,$data["can_delete"]);
        $this->db->bind(7,$data["can_update"]);
        $this->db->bind(8,$data["dashboard_menu"]);
        $this->db->bind(9,$data["profile_menu"]);
        $this->db->bind(10,$data["formation_menu"]);
        $this->db->bind(11,$data["about_menu"]);
        $this->db->bind(12,$data["users_menu"]);
        $this->db->bind(13,$data["components_menu"]);
        $this->db->bind(14,$data["user_id"]);
        $this->db->bind(15,date("Y-m-d H:i:s"));
        $this->db->bind(16,$data["status_id"]);
        return $this->db->executeQuery();

    }

    public function delete( $data ){
        $this->db->query("call sp_delete_auth_permissions(?,?,?)");
        $this->db->bind(1,$data["id"]);
        $this->db->bind(2,date("Y-m-d H:i:s"));
        $this->db->bind(3,$data["deleted_by"]);
        return $this->db->executeQuery() ?? false;
    }
}