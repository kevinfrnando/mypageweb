<?php


class Covers
{
    public function __construct( $con = null ){
        $this->db = new DDBBHandler( $con );
    }

    public function getData( $start, $limit ){
        $this->db->query("call SP_GET_COVERS( :start, :limit)");
        $this->db->bind( ":start" , $start);
        $this->db->bind( ":limit" , $limit);
        return $this->db->getAll();
    }
    public function getPageCovers( ){
        $this->db->query("CALL SP_GET_PAGES_COVERS( )");
        return $this->db->getAll();
    }

    public function insert( $data ){
        $this->db->query("call SP_INSERT_COVER(?,?,?,?,?,?,?)");
        $this->db->bind(1,$data["title"]);
        $this->db->bind(2,$data["description"]);
        $this->db->bind(3,$data["url"]);
        $this->db->bind(4,$data["nav_id"]);
        $this->db->bind(5,date("Y-m-d H:i:s"));
        $this->db->bind(6,$data["user_id"]);
        $this->db->bind(7,$data["status_id"]);
        return $this->db->executeQuery() ;
    }

    public function getCover($id){
        $this->db->query("call SP_FIND_COVER(?)");
        $this->db->bind(1, $id);
        return $this->db->getRecord( );
    }

    public function countRows(){
        $this->db->query("CALL SP_COUNT_COVERS()");
        return $this->db->getRecord();
    }

    public function update($data){
        $this->db->query("call SP_UPDATE_COVER(?,?,?,?,?,?,?,?)");
        $this->db->bind(1,$data["id"]);
        $this->db->bind(2,$data["title"]);
        $this->db->bind(3,$data["description"]);
        $this->db->bind(4,$data["url"]);
        $this->db->bind(5,$data["nav_id"]);
        $this->db->bind(6,date("Y-m-d H:i:s"));
        $this->db->bind(7,$data["user_id"]);
        $this->db->bind(8,$data["status_id"]);
        return $this->db->executeQuery() ?? false;
    }

    public function delete ( $data ){
        $this->db->query("call SP_DELETE_COVER(?,?,?)");
        $this->db->bind(1,date("Y-m-d H:i:s"));
        $this->db->bind(2,$data["deleted_by"]);
        $this->db->bind(3,$data["id"]);
        return $this->db->executeQuery() ?? false;
    }
}