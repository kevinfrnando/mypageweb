<?php


class About
{

    public function __construct(){
        $this->db = new DDBBHandler();
    }

    public function getData(){
        $this->db->query("CALL SP_GET_ABOUT_ME()");
        return $this->db->getAll();
    }
    public function insert( $data ){
        $this->db->query("CALL SP_INSERT_ABOUT_ME(?,?,?,?,?,?)");
        $this->db->bind(1,$data["description"]);
        $this->db->bind(2,$data["profile_id"]);
        $this->db->bind(3,date("Y-m-d H:i:s"));
        $this->db->bind(4,$data["user_id"]);
        $this->db->bind(5,$data["status_id"]);
        $this->db->bind(6,$data["image_url"]);
        return $this->db->executeQuery() ;
    }
}