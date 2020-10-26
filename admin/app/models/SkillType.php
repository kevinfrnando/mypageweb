<?php


class SkillType
{
    public function __construct( $con = null ){
        $this->db = new DDBBHandler( $con );
    }

    public function getAll(){
        $this->db->query("CALL SP_GET_ALL_SKILL_TYPE");
        return $this->db->getAll();
    }
    public function getPageSkillsType( $id ){
        $this->db->query("CALL SP_GET_PAGE_SKILL_TYPE( ? )");
        $this->db->bind( 1 , $id);
        return $this->db->getAll();
    }

    public function getData( $start, $limit ){
        $this->db->query("CALL SP_GET_SKILL_TYPE( :start, :limit)");
        $this->db->bind( ":start" , $start);
        $this->db->bind( ":limit" , $limit);
        return $this->db->getAll();
    }
    public function insert( $data ){
        $this->db->query("call SP_INSERT_SKILL_TYPE(?,?,?,?,?)");
        $this->db->bind(1,$data["description"]);
        $this->db->bind(2,1);
        $this->db->bind(3,date("Y-m-d H:i:s"));
        $this->db->bind(4,$data["user_id"]);
        $this->db->bind(5,$data["status_id"]);
        return $this->db->executeQuery() ;
    }

    public function getSkillType($id){
        $this->db->query("call SP_FIND_SKILL_TYPE(?)");
        $this->db->bind(1, $id);
        return $this->db->getRecord( );
    }

    public function countRows(){
        $this->db->query("CALL SP_COUNT_SKILL_TYPE()");
        return $this->db->getRecord();
    }

    public function update($data){
        $this->db->query("call SP_UPDATE_SKILL_TYPE(?,?,?,?,?)");
        $this->db->bind(1,$data["id"]);
        $this->db->bind(2,$data["description"]);
        $this->db->bind(3,date("Y-m-d H:i:s"));
        $this->db->bind(4,$data["user_id"]);
        $this->db->bind(5,$data["status_id"]);
        return $this->db->executeQuery() ?? false;
    }

    public function delete ( $data ){
        $this->db->query("call SP_DELETE_SKILL_TYPE(?,?,?)");
        $this->db->bind(1,date("Y-m-d H:i:s"));
        $this->db->bind(2,$data["deleted_by"]);
        $this->db->bind(3,$data["id"]);
        return $this->db->executeQuery() ?? false;
    }
    public function getSkillsTypeIn($ids){
        $this->db->query("CALL sp_get_skills_type_in(:ids)");
        $this->db->bind(":ids", $ids);
        return $this->db->getAll();
    }
}