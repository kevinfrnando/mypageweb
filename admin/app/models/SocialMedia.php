<?php


class SocialMedia{

    public function __construct( $con = null ){
        $this->db = new DDBBHandler( $con );
    }

    public function getData( $start, $limit ){
        $this->db->query("call SP_GET_SOCIAL_MEDIA( :start, :limit)");
        $this->db->bind( ":start" , $start);
        $this->db->bind( ":limit" , $limit);
        return $this->db->getAll();
    }

    public function getPageSocialMedia( $id ){
        $this->db->query("call SP_GET_PAGE_SOCIAL_MEDIA( :id )");
        $this->db->bind( ":id" , $id);
        return $this->db->getAll();
    }
    public function insert( $data ){
        $this->db->query("call SP_INSERT_SOCIAL_MEDIA(?,?,?,?,?,?,?)");
        $this->db->bind(1,$data["description"]);
        $this->db->bind(2,$data["url"]);
        $this->db->bind(3,$data["ico"]);
        $this->db->bind(4,$data["profile_id"]);
        $this->db->bind(5,date("Y-m-d H:i:s"));
        $this->db->bind(6,$data["user_id"]);
        $this->db->bind(7,$data["status_id"]);
        return $this->db->executeQuery() ;
    }

    public function getSocialMedia( $id ){
        $this->db->query("call SP_FIND_SOCIAL_MEDIA(?)");
        $this->db->bind(1, $id);
        return $this->db->getRecord( );
    }

    public function countRows(){
        $this->db->query("CALL SP_COUNT_SOCIAL_MEDIA()");
        return $this->db->getRecord();
    }

    public function update($data){
        $this->db->query("call SP_UPDATE_SOCIAL_MEDIA(?,?,?,?,?,?,?)");
        $this->db->bind(1,$data["id"]);
        $this->db->bind(2,$data["description"]);
        $this->db->bind(3,$data["url"]);
        $this->db->bind(4,$data["ico"]);
        $this->db->bind(5,date("Y-m-d H:i:s"));
        $this->db->bind(6,$data["user_id"]);
        $this->db->bind(7,$data["status_id"]);
        return $this->db->executeQuery() ?? false;
    }

    public function delete ( $data ){
        $this->db->query("call SP_DELETE_SOCIAL_MEDIA(?,?,?)");
        $this->db->bind(1,date("Y-m-d H:i:s"));
        $this->db->bind(2,$data["deleted_by"]);
        $this->db->bind(3,$data["id"]);
        return $this->db->executeQuery() ?? false;
    }

}