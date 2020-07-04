<?php

    class UsersController extends Controller {

        public function __construct(){
            $this->user = $this->model("AuthUser");
            $this->status = $this->model("MainStatus");
            $this->permission = $this->model("AuthPermissions");
        }

        public function index( $i = 1 ){

            /**
             *  Paginacion
             *  1.- Se obtiene el numero de registros
             *  2.- Se estalece el inicio con el indice pasado por parametro, por default sera el 1
             *  3.- Se divide para obtener la cantidad de tabs por todos los registros
             *
             */
            $rowsPerPage = 5;
            $rowCounts = $this->user->countRows()->count;
            $start = ( $i - 1) * $rowsPerPage;
            $totalTabs = ceil($rowCounts / $rowsPerPage);
            $users = $this->user->getData($start,$rowsPerPage);
            /**
             *  Obtenemos los ids de los registros corespondientes a los usuarios para luego obtenerlos en la consulta
             *
             */
            $statusId = [];
            $usersId = [];

            foreach ( $users as $user){
                array_push( $usersId, $user->created_by);
                array_push( $usersId, $user->updated_by == null ? 0 : $user->updated_by);
                array_push( $statusId, $user->status_id);
            }

            /**
             *  Construcion del parametro para las consultas SQL --- in () ---
             */
            $statusId = array_unique( $statusId );
            $usersId = array_unique( $usersId );

            $statusId = implode(",", $statusId );
            $usersId = implode(",", $usersId );

            $usersArray = $this->user->getUsersIn($usersId);
            $statusArray = $this->status->getMainStatusIn($statusId);

            $data = [
                "users" => $users,
                "totalTabs" => $totalTabs,
                "usersArray" => $usersArray,
                "statusArray" => $statusArray,
                "current" => $i
            ];
            $this->view("users/index", $data);
        }

        public function insert($id = null){
            if( $_SERVER["REQUEST_METHOD"] == "POST") {
                $data = [
                    "id" => helpers::decrypt($id),
                    "first_name" => helpers::fieldValidation($_POST["first_name"]),
                    "last_name" => helpers::fieldValidation($_POST["last_name"]),
                    "user" => helpers::fieldValidation($_POST["user"]),
                    "email" => helpers::fieldValidation($_POST["email"]),
                    "password" => helpers::fieldValidation($_POST["password"]),
                    "password_validation" => helpers::fieldValidation($_POST["password_validation"]),
                    "permission" => helpers::fieldValidation($_POST["permission"]),
                    "user_id" => $_SESSION["user"]["id"],
                    "status" => helpers::fieldValidation($_POST["status"]),
                    "passwordError" => false
                ];

                if( $data["password"] == $data["password_validation"]){

                    if( $data["id"] == null ){
                        if( $this->user->insert($data)){
                            helpers::redirecction("users");
                        }else{
                            die("Algo salio mal");
                        }
                    } else{

                        if( $this->user->update($data)){
                            helpers::redirecction("users");
                        }else{
                            die("Algo salio mal");
                        }
                    }
                }else{
                    $data["passwordError"] = true;
                    $data["permissionsArray"] = $this->permission->getAll();
                    $data["statusArray"] = $this->status->getAll();

                    $this->view("users/insert", $data);
                }

            }else if( ($id != null) && ( $_SERVER["REQUEST_METHOD"] != "POST" )){

                /**
                 * Obtener info desde modelo
                 */

                $user = $this->user->getUser(helpers::decrypt($id));
                $data = [
                    "id" => $user->id,
                    "first_name" => $user->first_name,
                    "last_name" => $user->last_name,
                    "user" => $user->user,
                    "email" => $user->email,
                    "password" => $user->password,
                    "permissions" => $user->permissions_id,
                    "status" => $user->status_id,
                    "permissionsArray" => $this->permission->getAll(),
                    "statusArray" => $this->status->getAll(),
                    "passwordError" => false
                ];

                $this->view("users/insert", $data);
            }else{
                $data = [
                    "id" => null,
                    "first_name" => "",
                    "last_name" => "",
                    "user" => "",
                    "email" => "",
                    "password" => "",
                    "status" => "",
                    "permissions" => "",
                    "permissionsArray" => $this->permission->getAll(),
                    "statusArray" => $this->status->getAll(),
                    "passwordError" => false
                ];

                $this->view("users/insert", $data);
            }
        }

        public function delete($id){
            if( $id != null ){
                $url = $_SERVER['HTTP_REFERER'];
                $data = [
                    "id" => helpers::decrypt($id),
                    "deleted_by" => $_SESSION["user"]["id"]
                ];
                if( $this->user->delete($data)){
                    header("Location: ".$url);
                }else{
                    die("Algo salio mal");
                }
            }

        }

    }
