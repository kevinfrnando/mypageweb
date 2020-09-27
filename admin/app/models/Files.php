<?php


class Files
{
    public function __construct(){
        $this->db = new DDBBHandler();
    }

    public function insert( $data ){
        $this->db->query("call SP_INSERT_MEDIA(?,?,?,?,?,?,?,?)");
        $this->db->bind(1,$data["folder_path"]);
        $this->db->bind(2,$data["folder_name"]);
        $this->db->bind(3,$data["name"]);
        $this->db->bind(4,$data["type"]);
        $this->db->bind(5,$data["size"]);
        $this->db->bind(6,date("Y-m-d H:i:s"));
        $this->db->bind(7,$data["user_id"]);
        $this->db->bind(8,$data["status_id"]);
        return $this->db->executeQuery() ;
    }

    public function getFile( $id ){
        $this->db->query("call SP_FIND_MEDIA(?)");
        $this->db->bind(1, $id);
        return $this->db->getRecord( );
    }

    public function nextFile( $name ){
        $this->db->query("call SP_NEXT_MEDIA(?)");
        $this->db->bind(1, $name);
        $next = $this->db->getRecord()->count;
        $name = "0000";
        return substr( $name, strlen($next)).$next;
    }
    public function getFilesIn($ids){
        $this->db->query("CALL sp_get_files_in(:ids)");
        $this->db->bind(":ids", $ids);
        return $this->db->getAll();
    }
    public function getLastId(){
        $this->db->query("SELECT LAST_INSERT_ID()");
        return $this->db->getLastInsert();
    }
}