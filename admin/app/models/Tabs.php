<?php


class Tabs
{
    public function __construct(){
        $this->db = new Connection();
    }

    public function getData( $start, $limit ){
        $this->db->query("call sp_get_tabs( :start, :limit)");
        $this->db->bind( ":start" , $start);
        $this->db->bind( ":limit" , $limit);
        return $this->db->getAll();
    }

    public function insert( $data ){
        $this->db->query("call sp_insert_tab(?,?,?,?,?,?)");
        $this->db->bind(1,$data["code"]);
        $this->db->bind(2,$data["description"]);
        $this->db->bind(3,1);
        $this->db->bind(4,date("Y-m-d H:i:s"));
        $this->db->bind(5,$data["user_id"]);
        $this->db->bind(6,$data["status_id"]);

        return $this->db->executeQuery() ;
    }
    public function getTab($id){
        $this->db->query("call sp_find_tab(?)");
        $this->db->bind(1, $id);
        return $this->db->getRecord();
    }

    public function countRows(){
        $this->db->query(" CALL sp_count_tabs()");
        return $this->db->getRecord();
    }

    public function update($data){
        $this->db->query("call sp_update_tab(?,?,?,?,?,?,?)");
        $this->db->bind(1,$data["id"]);
        $this->db->bind(2,$data["code"]);
        $this->db->bind(3,$data["description"]);
        $this->db->bind(4,1);
        $this->db->bind(5,date("Y-m-d H:i:s"));
        $this->db->bind(6,$data["user_id"]);
        $this->db->bind(7,$data["status_id"]);
        return $this->db->executeQuery() ?? false;
    }

    public function delete ( $data ){
        $this->db->query("call sp_delete_tab(?,?,?)");
        $this->db->bind(1,date("Y-m-d H:i:s"));
        $this->db->bind(2,$data["deleted_by"]);
        $this->db->bind(3,$data["id"]);
        return $this->db->executeQuery() ?? false;
    }




}