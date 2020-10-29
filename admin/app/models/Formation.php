<?php


class Formation
{
    public function __construct( $con = null ){
        $this->db = new DDBBHandler( $con );
    }

    public function getData( $start, $limit ){
        $this->db->query("call SP_GET_PROFILE_FORMATION( :start, :limit)");
        $this->db->bind( ":start" , $start);
        $this->db->bind( ":limit" , $limit);
        return $this->db->getAll();
    }

    public function getPageFormation( $id ){
        $this->db->query("CALL SP_GET_PAGE_PROFILE_FORMATION( ? )");
        $this->db->bind( 1 , $id);
        return $this->db->getAll();
    }

    public function insert( $data ){
        $this->db->query("call SP_INSERT_PROFILE_FORMATION(?,?,?,?,?,?,?,?,?)");
        $this->db->bind(1,$data["title"]);
        $this->db->bind(2,$data["course"]);
        $this->db->bind(3,$data["start"]);
        $this->db->bind(4,$data["end"]);
        $this->db->bind(5,$data["institute"]);
        $this->db->bind(6,$data["profile_id"]);
        $this->db->bind(7,date("Y-m-d H:i:s"));
        $this->db->bind(8,$data["user_id"]);
        $this->db->bind(9,$data["status_id"]);
        return $this->db->executeQuery() ;
    }

    public function getProject($id){
        $this->db->query("call SP_FIND_PROFILE_FORMATION(?)");
        $this->db->bind(1, $id);
        return $this->db->getRecord( );
    }

    public function countRows(){
        $this->db->query("CALL SP_COUNT_PROFILE_FORMATION()");
        return $this->db->getRecord();
    }

    public function update($data){
        $this->db->query("call SP_UPDATE_PROFILE_FORMATION(?,?,?,?,?,?,?,?,?)");
        $this->db->bind(1,$data["title"]);
        $this->db->bind(2,$data["course"]);
        $this->db->bind(3,$data["start"]);
        $this->db->bind(4,$data["end"]);
        $this->db->bind(5,$data["institute"]);
        $this->db->bind(6,date("Y-m-d H:i:s"));
        $this->db->bind(7,$data["user_id"]);
        $this->db->bind(8,$data["status_id"]);
        $this->db->bind(9,$data["id"]);
        return $this->db->executeQuery() ?? false;
    }

    public function delete ( $data ){
        $this->db->query("call SP_DELETE_PROFILE_FORMATION(?,?,?)");
        $this->db->bind(1,date("Y-m-d H:i:s"));
        $this->db->bind(2,$data["deleted_by"]);
        $this->db->bind(3,$data["id"]);
        return $this->db->executeQuery() ?? false;
    }
}