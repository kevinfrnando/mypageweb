<?php
class MainProfile{

    public function __construct(){
        $this->db = new Connection();
    }

    public function getData(){
        $this->db->query("select * from main_profile where id = 1");
        return $this->db->getRecord();
    }

    public function update($data){
        $this->db->query("UPDATE main_profile set
            main_name = :main_name,
            main_legend = :main_legend,
            bio_title = :bio_title,
            bio_legend =:bio_legend,
            bio_profile = :bio_profile
            where id = :id
        ");
        $this->db->bind(":main_name" , $data["main_name"]);
        $this->db->bind(":main_legend" , $data["main_legend"]);
        $this->db->bind(":bio_title" , $data["bio_title"]);
        $this->db->bind(":bio_legend" , $data["bio_legend"]);
        $this->db->bind(":bio_profile" , $data["bio_profile"]);
        $this->db->bind(":id" , $data["id"]);

        return $this->db->executeQuery() ?? false;
    }

}