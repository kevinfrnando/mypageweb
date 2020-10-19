<?php


class ExperienceDetail
{
    public function __construct(){
        $this->db = new DDBBHandler();
    }

    public function getData( $experienceId ){
        $this->db->query("call SP_GET_EXPERIENCE_DETAILS(:_experience_id)");
        $this->db->bind( ":_experience_id" , $experienceId);
        return $this->db->getAll();
    }

    public function insert( $data ){
        $this->db->query("call SP_INSERT_EXPERIENCE_DETAIL(:description, :experience_id, :created_on, :created_by, :status_id)");
        $this->db->bind(":description",$data["description"]);
        $this->db->bind(":experience_id",$data["experienceId"]);
        $this->db->bind(":created_on",date("Y-m-d H:i:s"));
        $this->db->bind(":created_by",$data["user_id"]);
        $this->db->bind(":status_id",$data["status_id"]);
        return $this->db->executeQuery() ;
    }

    public function update($data){
        $this->db->query("call SP_UPDATE_EXPERIENCE_DETAIL(:id, :description, :experience_id, :updated_on, :updated_by, :status_id)");
        $this->db->bind(":id",$data["id"]);
        $this->db->bind(":description",$data["description"]);
        $this->db->bind(":experience_id",$data["experienceId"]);
        $this->db->bind(":updated_on",date("Y-m-d H:i:s"));
        $this->db->bind(":updated_by",$data["user_id"]);
        $this->db->bind(":status_id",$data["status_id"]);
        return $this->db->executeQuery() ?? false;
    }

    public function delete ( $data ){
        $this->db->query("call SP_DELETE_EXPERIENCE_DETAILS(:id,:deleted_by, :deleted_on)");
        $this->db->bind(":id",$data["id"]);
        $this->db->bind(":deleted_on",date("Y-m-d H:i:s"));
        $this->db->bind(":deleted_by",$data["user_id"]);
        return $this->db->executeQuery() ?? false;
    }

    public function deleteIn ( $data ){
        $this->db->query("call SP_DELETE_IN_EXPERIENCE_DETAILS(:deleted_on, :deleted_by, :experience_id, :ids)");
        $this->db->bind(":deleted_on",date("Y-m-d H:i:s"));
        $this->db->bind(":deleted_by",$data["user_id"]);
        $this->db->bind(":experience_id",$data["experience_id"]);
        $this->db->bind(":ids",$data["ids"]);
        return $this->db->executeQuery() ?? false;
    }

}