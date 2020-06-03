<?php

    class UsersController extends Controller {

        public function __construct(){
            $this->user = $this->model("AuthUser");
        }

        public function index(){
            $users = $this->user->getAll();
            /**
             * Obtener registros
             */
            $data = [
                "users" => $users
            ];
            $this->view("users/index", $data);
        }

        public function insert($id = null){
            if( $_SERVER["REQUEST_METHOD"] == "POST") {
                $data = [
                    "id" => $id,
                    "first_name" => helpers::fieldValidation($_POST["first_name"]),
                    "last_name" => helpers::fieldValidation($_POST["last_name"]),
                    "user" => helpers::fieldValidation($_POST["user"]),
                    "email" => helpers::fieldValidation($_POST["email"]),
                    "password" => helpers::fieldValidation($_POST["password"]),
                    "permissions" => helpers::fieldValidation($_POST["permissions"]),
                    "status" => helpers::fieldValidation($_POST["status"]),
                ];

                if( $id == null ){
                    if( $this->user->insert($data)){
                        helpers::redirecction("users");
                    }else{
                        die("Algo salio mal");
                    }
                }else{
                    if( $this->user->update($data)){
                        helpers::redirecction("users");
                    }else{
                        die("Algo salio mal");
                    }
                }

            }else if( ($id != null) && ( $_SERVER["REQUEST_METHOD"] != "POST" )){

                /**
                 * Obtener info desde modelo
                 */

                $user = $this->user->getUser($id);
                $data = [
                    "id" => $user->id,
                    "first_name" => $user->first_name,
                    "last_name" => $user->last_name,
                    "user" => $user->user,
                    "email" => $user->email,
                    "password" => $user->password,
                    "permissions" => $user->permissions_id,
                    "status" => $user->status_id,
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
                    "permissions" => "",
                    "status" => "",
                ];

                $this->view("users/insert", $data);
            }
        }

        public function delete($id){
            if( $id != null ){
                if( $this->user->delete($id)){
                    helpers::redirecction("users");
                }else{
                    die("Algo salio mal");
                }
            }
        }

    }
