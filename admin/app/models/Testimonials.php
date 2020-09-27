<?php


class Testimonials{
    public function __construct(){
        $this->db = new DDBBHandler();
    }


    public function getData( $start, $limit ){
        $this->db->query("call SP_GET_TESTIMONIALS( :start, :limit)");
        $this->db->bind( ":start" , $start);
        $this->db->bind( ":limit" , $limit);
        return $this->db->getAll();
    }
    public function insert( $data ){
        var_dump($data);
        $this->db->query("call SP_INSERT_TESTIMONIALS(?,?,?,?,?,?,?,?,?)");
        $this->db->bind(1,$data["code"]);
        $this->db->bind(2,$data["description"]);
        $this->db->bind(3,$data["author"]);
        $this->db->bind(4,$data["title"]);
        $this->db->bind(5,$data["profile_id"]);
        $this->db->bind(6,$data["image_url"]);
        $this->db->bind(7,date("Y-m-d H:i:s"));
        $this->db->bind(8,$data["user_id"]);
        $this->db->bind(9,$data["status_id"]);
        return $this->db->executeQuery() ;
    }

    public function getTestimonial( $id ){
        $this->db->query("call SP_FIND_TESTIMONIALS(?)");
        $this->db->bind(1, $id);
        return $this->db->getRecord( );
    }

    public function countRows(){
        $this->db->query("CALL SP_COUNT_TESTIMONIALS()");
        return $this->db->getRecord();
    }

    public function update($data){
        $this->db->query("call SP_UPDATE_TESTIMONIALS(?,?,?,?,?,?,?,?,?,?)");
        $this->db->bind(1,$data["id"]);
        $this->db->bind(2,$data["code"]);
        $this->db->bind(3,$data["description"]);
        $this->db->bind(4,$data["author"]);
        $this->db->bind(5,$data["title"]);
        $this->db->bind(6,$data["profile_id"]);
        $this->db->bind(7,$data["image_url"]);
        $this->db->bind(8,date("Y-m-d H:i:s"));
        $this->db->bind(9,$data["user_id"]);
        $this->db->bind(10,$data["status_id"]);
        return $this->db->executeQuery() ?? false;
    }

    public function delete ( $data ){
        $this->db->query("call SP_DELETE_TESTIMONIALS(?,?,?)");
        $this->db->bind(1,date("Y-m-d H:i:s"));
        $this->db->bind(2,$data["deleted_by"]);
        $this->db->bind(3,$data["id"]);
        return $this->db->executeQuery() ?? false;
    }


    public function getLastId(){
        return $this->db->getLastInsert();
    }
}