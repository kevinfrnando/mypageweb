<?php


class Skills
{
    public function __construct( $con = null ){
        $this->db = new DDBBHandler( $con );
    }

    public function getData( $start, $limit ){
        $this->db->query("call SP_GET_SKILLS( :start, :limit)");
        $this->db->bind( ":start" , $start);
        $this->db->bind( ":limit" , $limit);
        return $this->db->getAll();
    }

    public function getPageSkills( $skillsType ){
        $ids = [];
        foreach ( $skillsType as $type){
            array_push( $ids, $type->id );
        }
        $ids = array_unique( $ids);
        $ids = implode(",", $ids );
        $this->db->query("call SP_GET_PAGE_SKILLS( :ids )");
        $this->db->bind( ":ids" , $ids);

        return $this->db->getAll();
    }
    public function insert( $data ){
        $this->db->query("call SP_INSERT_SKILLS(?,?,?,?,?,?)");
        $this->db->bind(1,$data["description"]);
        $this->db->bind(2,$data["percentage"]);
        $this->db->bind(3,$data["skills_type_id"]);
        $this->db->bind(4,date("Y-m-d H:i:s"));
        $this->db->bind(5,$data["user_id"]);
        $this->db->bind(6,$data["status_id"]);
        return $this->db->executeQuery() ;
    }

    public function getSkill($id){
        $this->db->query("call SP_FIND_SKILL(?)");
        $this->db->bind(1, $id);
        return $this->db->getRecord( );
    }

    public function countRows(){
        $this->db->query("CALL SP_COUNT_SKILLS()");
        return $this->db->getRecord();
    }

    public function update($data){
        $this->db->query("call SP_UPDATE_SKILLS(?,?,?,?,?,?,?)");
        $this->db->bind(1,$data["id"]);
        $this->db->bind(2,$data["description"]);
        $this->db->bind(3,$data["percentage"]);
        $this->db->bind(4,$data["skills_type_id"]);
        $this->db->bind(5,date("Y-m-d H:i:s"));
        $this->db->bind(6,$data["user_id"]);
        $this->db->bind(7,$data["status_id"]);
        return $this->db->executeQuery() ?? false;
    }

    public function delete ( $data ){
        $this->db->query("call SP_DELETE_SKILL(?,?,?)");
        $this->db->bind(1,date("Y-m-d H:i:s"));
        $this->db->bind(2,$data["deleted_by"]);
        $this->db->bind(3,$data["id"]);
        return $this->db->executeQuery() ?? false;
    }
}