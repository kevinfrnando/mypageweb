<?php


class MainStatus{
    public function __construct(){
        $this->db = new Connection;
    }

    public function getAll(){
        $this->db->query("CALL sp_get_main_status");
        return $this->db->getAll();
    }
}