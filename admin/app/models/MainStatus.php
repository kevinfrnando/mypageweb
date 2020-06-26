<?php


class MainStatus{
    public function __construct(){
        $this->db = new Connection;
    }

    public function getAll(){
        $this->db->query("CALL sp_get_main_status");
        return $this->db->getAll();
    }

    public function getMainStatusIn($ids){
        $this->db->query("CALL sp_get_main_status_in(:ids)");
        $this->db->bind(":ids", $ids);
        return $this->db->getAll();
    }
}