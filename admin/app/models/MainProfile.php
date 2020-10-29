<?php
class MainProfile{

    public function __construct( $con = null ){
        $this->db = new DDBBHandler( $con );
    }

    public function getData(){
        $this->db->query("CALL SP_FIND_MAIN_PROFILE(?)");
        $this->db->bind(1, 1);
        return $this->db->getRecord();
    }

    public function getProfileData(){
        $this->db->query("CALL SP_GET_MAIN_PROFILE(?)");
        $this->db->bind(1, 1);
        return $this->db->getRecord();
    }

    public function update($data){
        $this->db->query("CALL SP_UPDATE_MAIN_PROFILE(
                :id,
                :main_name,
                :main_legend,
                :bio_title,
                :bio_legend,
                :bio_profile,
                :updated_by,
                :updated_on,
                :birthday, 
                :nationality, 
                :residency, 
                :profession, 
                :freelance,
                :blood,
                :email,
                :movil)");
        $this->db->bind(":main_name" , $data["main_name"]);
        $this->db->bind(":main_legend" , $data["main_legend"]);
        $this->db->bind(":bio_title" , $data["bio_title"]);
        $this->db->bind(":bio_legend" , $data["bio_legend"]);
        $this->db->bind(":bio_profile" , $data["bio_profile"]);
        $this->db->bind(":updated_by" , $data["user_id"]);
        $this->db->bind(":updated_on" , date("Y-m-d H:i:s"));
        $this->db->bind(":birthday" , $data["birthday"]);
        $this->db->bind(":nationality" , $data["nationality"]);
        $this->db->bind(":residency" , $data["residency"]);
        $this->db->bind(":profession" , $data["profession"]);
        $this->db->bind(":freelance" , $data["freelance"]);
        $this->db->bind(":blood" , $data["blood"]);
        $this->db->bind(":email" , $data["email"]);
        $this->db->bind(":movil" , $data["movil"]);
        $this->db->bind(":id" , $data["id"]);

        return $this->db->executeQuery() ?? false;
    }

}