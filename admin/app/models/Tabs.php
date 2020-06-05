<?php


class Tabs
{
    public function __construct(){
        $this->db = new Connection();
    }

    public function getData(){
        $this->db->query("SELECT * FROM tabs");
        return $this->db->getAll();
    }
}