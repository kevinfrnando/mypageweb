<?php


class CoversNavs
{
    public function __construct( $con = null ){
        $this->db = new DDBBHandler( $con );
    }
    public function getPageCoversNav( $id ){
        $this->db->query("CALL SP_GET_PAGES_COVERS_NAV( :id )");
        $this->db->bind( ":id" , $id);
        return $this->db->getAll();

    }
    public function getData( $start, $limit ){
        $this->db->query("call SP_GET_NAVS_COVER( :start, :limit)");
        $this->db->bind( ":start" , $start);
        $this->db->bind( ":limit" , $limit);
        return $this->db->getAll();
    }

    public function getAll( ){
        $this->db->query("call SP_GET_ALL_NAVS_COVER( )");
        return $this->db->getAll();
    }
    public function insert( $data ){
        $this->db->query("call SP_INSERT_NAVS_COVER(?,?,?,?,?)");
        $this->db->bind(1,$data["description"]);
        $this->db->bind(2,$data["profile_id"]);
        $this->db->bind(3,date("Y-m-d H:i:s"));
        $this->db->bind(4,$data["user_id"]);
        $this->db->bind(5,$data["status_id"]);
        return $this->db->executeQuery() ;
    }

    public function getNavCover($id){
        $this->db->query("call SP_FIND_NAVS_COVER(?)");
        $this->db->bind(1, $id);
        return $this->db->getRecord( );
    }

    public function getCoversNavIn($id){
        $this->db->query("call SP_GET_NAVS_COVERS_IN(?)");
        $this->db->bind(1, $id);
        return $this->db->getAll( );
    }

    public function countRows(){
        $this->db->query("CALL SP_COUNT_NAVS_COVER()");
        return $this->db->getRecord();
    }

    public function update($data){
        $this->db->query("call SP_UPDATE_NAVS_COVER(?,?,?,?,?)");
        $this->db->bind(1,$data["id"]);
        $this->db->bind(2,$data["description"]);
        $this->db->bind(3,date("Y-m-d H:i:s"));
        $this->db->bind(4,$data["user_id"]);
        $this->db->bind(5,$data["status_id"]);
        return $this->db->executeQuery() ?? false;
    }

    public function delete ( $data ){
        $this->db->query("call SP_DELETE_NAVS_COVER(?,?,?)");
        $this->db->bind(1,date("Y-m-d H:i:s"));
        $this->db->bind(2,$data["deleted_by"]);
        $this->db->bind(3,$data["id"]);
        return $this->db->executeQuery() ?? false;
    }
}