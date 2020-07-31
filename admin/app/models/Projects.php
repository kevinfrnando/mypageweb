<?php


class Projects
{
    public function __construct(){
        $this->db = new Connection();
    }


    public function getData( $start, $limit ){
        $this->db->query("call SP_GET_MUSICAL_PROJECTS( :start, :limit)");
        $this->db->bind( ":start" , $start);
        $this->db->bind( ":limit" , $limit);
        return $this->db->getAll();
    }
    public function insert( $data ){
        $this->db->query("call SP_INSERT_MUSICAL_PROJECT(?,?,?,?,?,?,?,?)");
        $this->db->bind(1,$data["title"]);
        $this->db->bind(2,$data["description"]);
        $this->db->bind(3,$data["video_url"]);
        $this->db->bind(4,$data["profile_id"]);
        $this->db->bind(5,$data["image_url"]);
        $this->db->bind(6,date("Y-m-d H:i:s"));
        $this->db->bind(7,$data["user_id"]);
        $this->db->bind(8,$data["status_id"]);
        return $this->db->executeQuery() ;
    }

    public function getProject($id){
        $this->db->query("call SP_FIND_MUSICAL_PROJECTS(?)");
        $this->db->bind(1, $id);
        return $this->db->getRecord( );
    }

    public function countRows(){
        $this->db->query("CALL SP_COUNT_MUSICAL_PROJECTS()");
        return $this->db->getRecord();
    }

    public function update($data){
        $this->db->query("call SP_UPDATE_MUSICAL_PROJECTS(?,?,?,?,?,?,?,?,?)");
        $this->db->bind(1,$data["id"]);
        $this->db->bind(2,$data["description"]);
        $this->db->bind(3,$data["video_url"]);
        $this->db->bind(4,$data["title"]);
        $this->db->bind(5,$data["profile_id"]);
        $this->db->bind(6,$data["image_url"]);
        $this->db->bind(7,date("Y-m-d H:i:s"));
        $this->db->bind(8,$data["user_id"]);
        $this->db->bind(9,$data["status_id"]);
        return $this->db->executeQuery() ?? false;
    }

    public function delete ( $data ){
        $this->db->query("call SP_DELETE_MUSICAL_PROJECT(?,?,?)");
        $this->db->bind(1,date("Y-m-d H:i:s"));
        $this->db->bind(2,$data["deleted_by"]);
        $this->db->bind(3,$data["id"]);
        return $this->db->executeQuery() ?? false;
    }
}