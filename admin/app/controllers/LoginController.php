<?php

class loginController extends Controller{

    public function __construct(){
        $this->login = $this->model("Login");
        $this->status = $this->model("MainStatus");
        $this->permission = $this->model("AuthPermissions");
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
            $data = $this->login->loginValidation($data);
            if( !is_null($data["status"])  && !is_null(  $data["userId"]) ){
                $loginData = [
                    "host" => gethostname(),
                    "app_name" => APP_NAME,
                    "browser" => helpers::getBrowser($_SERVER['HTTP_USER_AGENT']),
                    "ip" => helpers::getRealIP(),
                    "type" => 1,
                    "user_id" => $data["userId"]
                ];
                $loginResponse = $this->login->login($loginData);
                $permissions = $this->permission->getPermission($loginResponse->permissions_id);
                if( $loginResponse ){

                    $_SESSION["user"] = array(
                        "id" => $loginResponse->id,
                        "firstName" => $loginResponse->first_name,
                        "lastName" => $loginResponse->last_name,
                        "fullName" => $loginResponse->full_name,
                        "status_id" => $loginResponse->status_id,
                        "last_ip" => $loginResponse->last_ip,
                        "last_login" => $loginResponse->last_login,
                        "permissions" => $permissions
                    );
                    helpers::redirecction("dashboard");
                }

            }else{
                $this->view("login/index", $data);
            }

        }else{
            helpers::redirecction("login/index");
        }

    }

    public function logOut(){
        session_destroy();
        $loginData = [
            "host" => gethostname(),
            "app_name" => APP_NAME,
            "browser" => helpers::getBrowser($_SERVER['HTTP_USER_AGENT']),
            "ip" => helpers::getRealIP(),
            "type" => 2,
            "user_id" => $_SESSION["user"]["id"]
        ];
        $this->login->login($loginData);
        helpers::redirecction("login/index");
    }

    public function logs(){
        $data = [
            "logs" => $this->login->getLoginLogs()
        ];
        $this->view("login/logs", $data);
    }
}