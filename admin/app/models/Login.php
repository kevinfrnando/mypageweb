<?php
class Login{

    public function __construct(){
        $this->db = new Connection();
    }

    public function loginValidation($data){
        $this->db->query("CALL sp_login_validation( ?, ? , @outMessage, @outId, @outStatus )");
        $this->db->bind(1, $data["email"]);
        $this->db->bind(2, $data["password"]);

        $result = $this->db->currentQuery("select @outMessage, @outId, @outStatus");
        $outMessage = $result["@outMessage"];
        $outId = $result["@outId"];
        $outActive = $result["@outStatus"];

        return [
            "message" => $outMessage,
            "status" => $outActive,
            "userId" => $outId
        ];

    }

    public function login($data){
        $this->db->query("CALL sp_login(:host, :app_name, :browser, :ip, :date, :type, :user_id)");
        $this->db->bind(":host", $data["host"]);
        $this->db->bind(":app_name", $data["app_name"]);
        $this->db->bind(":browser", $data["browser"]);
        $this->db->bind(":ip", $data["ip"]);
        $this->db->bind(":date", date("Y-m-d H:i:s"));
        $this->db->bind(":type", $data["type"]);
        $this->db->bind(":user_id", $data["user_id"]);
        return $this->db->getRecord();
    }

    public function getLoginLogs(){
        $this->db->query("CALL sp_login_logs()");
        return $this->db->getAll();
    }

}