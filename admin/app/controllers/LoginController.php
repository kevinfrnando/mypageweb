<?php

class loginController extends Controller{

    public function __construct(){
        $this->login = $this->model("Login");
    }

    public function index(){
        $this->view("login/index");
    }

    public function login(){
        if( $_SERVER["REQUEST_METHOD"] == "POST") {
            $data = [
              "email" => helpers::fieldValidation($_POST["email"]),
              "password" => helpers::fieldValidation($_POST["password"])
            ];
            $record = $this->login->login($data);

            if($record){
                //
                //helpers::sessionStart();
                $_SESSION["user"] = array(
                    "id" => $record->id,
                    "firstName" => $record->first_name,
                    "lastName" => $record->last_name,
                    "fullName" => $record->full_name,
                    "status_id" => $record->status_id,
                    "last_ip" => $record->last_ip,
                    "last_login" => $record->last_login
                );
                //var_dump($_SESSION);
                helpers::redirecction("dashboard");
            }
            else{
                $data = [
                    "logged" => false,
                    "message" => "Usuario o clave Incorrecta."
                ];
                $this->view("login/index", $data);
            }

        }

    }

    public function logOut(){
        session_destroy();
        helpers::redirecction("login/index");
    }
}