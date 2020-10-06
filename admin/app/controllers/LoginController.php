<?php

class loginController extends Controller{

    public function __construct(){
        $this->login = $this->model("Login");
        $this->status = $this->model("MainStatus");
        $this->permissionsModel = $this->model("AuthPermissions");
        if( isset( $_SESSION["user"]["id"]) ){
            $sessionPermission = $_SESSION["user"]["permissions"];
            $this->permission = $this->permissionsModel->getPermission( $sessionPermission->id );
            $this->userModel = $this->model("AuthUser");
        }

        $this->path = "components/login/";
    }

    public function index(){
            $this->view($this->path."index");
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
                $permissions = $this->permissionsModel->getPermission($loginResponse->permissions_id);
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
                $this->view($this->path."index", $data);
            }

        }else{
            helpers::redirecction($this->path."index");
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
        helpers::redirecction($this->path."index");
    }

    public function logs( $i = 1 ){

        if( $this->permission->components_menu) {
            /**
             *  Paginacion
             *  1.- Se obtiene el numero de registros
             *  2.- Se estalece el inicio con el indice pasado por parametro, por default sera el 1
             *  3.- Se divide para obtener la cantidad de tabs por todos los registros
             *
             */
            $rowsPerPage = 5;
            $rowCounts = $this->login->countRows()->count;
            $start = ( $i - 1) * $rowsPerPage;
            $totalTabs = ceil($rowCounts / $rowsPerPage);
            $logs = $this->login->getLoginLogs($start,$rowsPerPage);


            /**
             *  Obtenemos los ids de los registros corespondientes a los usuarios para luego obtenerlos en la consulta
             *
             */
            $usersId = [];
            foreach ( $logs as $log){
                array_push( $usersId, $log->user_id);
            }

            /**
             *  Construcion del parametro para las consultas SQL --- in () ---
             */
            $usersId = array_unique( $usersId );

            $usersId = implode(",", $usersId );

            $usersArray = $this->userModel->getUsersIn($usersId);

            $data = [
                "logs"=> $logs,
                "totalTabs" => $totalTabs,
                "current" => $i,
                "usersArray" => $usersArray
            ];
            $this->view($this->path."logs", $data);
        }else {
            $this->view("notfound/deneged");
        }
    }
}