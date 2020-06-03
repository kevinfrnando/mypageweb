<?php
class Login{

    public function __construct(){
        $this->db = new Connection();
    }

    public function login($data){
        $this->db->query("SELECT * FROM auth_user WHERE email = :email AND password = :password");
        $this->db->bind(":email", $data["email"]);
        $this->db->bind(":password", $data["password"]);
        return $this->db->getRecord();

    }

}