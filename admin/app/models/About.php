<?php


class About
{

    public function __construct( $con = null ){
        $this->db = new DDBBHandler( $con );
    }

    public function getData(){
        $this->db->query("CALL SP_GET_ABOUT_ME()");
        return $this->db->getAll();
    }

    public function getPageAbout( $id ){
        $this->db->query("CALL SP_GET_PAGES_ABOUT( :id)");
        $this->db->bind(":id",$id);
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

    public function getAbout($id){
        $this->db->query("call SP_FIND_ABOUT_ME(?)");
        $this->db->bind(1, $id);
        return $this->db->getRecord( );
    }

    public function delete ( $data ){
        $this->db->query("call SP_DELETE_ABOUT_PROFILE(?,?,?)");
        $this->db->bind(1,date("Y-m-d H:i:s"));
        $this->db->bind(2,$data["deleted_by"]);
        $this->db->bind(3,$data["id"]);
        return $this->db->executeQuery() ?? false;
    }
}