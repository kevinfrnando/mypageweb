<?php
class MainProfile{

    public function __construct(){
        $this->db = new Connection();
    }

    public function getData(){
        $this->db->query("select * from main_profile where id = 1");
        return $this->db->getRecord();
    }

}