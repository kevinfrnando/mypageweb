<?php

    class UsersController extends Controller {

        public function __construct(){
            $this->userModel = $this->model("AuthUser");
            $this->statusModel = $this->model("MainStatus");
            $this->permissionsModel = $this->model("AuthPermissions");
            $sessionPermission = $_SESSION["user"]["permissions"];
            $this->permission = $this->permissionsModel->getPermission( $sessionPermission->id );
        }

        public function index( $i = 1 ){


            if( $this->permission->users_menu){
                /**
                 *  Paginacion
                 *  1.- Se obtiene el numero de registros
                 *  2.- Se estalece el inicio con el indice pasado por parametro, por default sera el 1
                 *  3.- Se divide para obtener la cantidad de tabs por todos los registros
                 *
                 */
                $rowsPerPage = 5;
                $rowCounts = $this->userModel->countRows()->count;
                $start = ( $i - 1) * $rowsPerPage;
                $totalTabs = ceil($rowCounts / $rowsPerPage);
                $users = $this->userModel->getData($start,$rowsPerPage);
                /**
                 *  Obtenemos los ids de los registros corespondientes a los usuarios para luego obtenerlos en la consulta
                 *
                 */
                $statusId = [];
                $usersId = [];
                $permissionsId = [];

                foreach ( $users as $user){
                    array_push( $usersId, $user->created_by);
                    array_push( $usersId, $user->updated_by == null ? 0 : $user->updated_by);
                    array_push( $statusId, $user->status_id);
                    array_push( $permissionsId, $user->permissions_id);
                }

                /**
                 *  Construcion del parametro para las consultas SQL --- in () ---
                 */
                $statusId = array_unique( $statusId );
                $usersId = array_unique( $usersId );
                $permissionsId = array_unique( $permissionsId );

                $statusId = implode(",", $statusId );
                $usersId = implode(",", $usersId );
                $permissionsId = implode(",", $permissionsId );

                $usersArray = $this->userModel->getUsersIn($usersId);
                $statusArray = $this->statusModel->getMainStatusIn($statusId);
                $permissionsArray = $this->permissionsModel->getPermissionsIn($permissionsId);

                $data = [
                    "users" => $users,
                    "totalTabs" => $totalTabs,
                    "usersArray" => $usersArray,
                    "statusArray" => $statusArray,
                    "permissionsArray" => $permissionsArray,
                    "permissions" => $this->permission,
                    "current" => $i
                ];

                $this->view("users/index", $data);
            }else{
                $this->view("notfound/deneged");
            }

        }

        public function insert($id = null){
            if( $this->permission->users_menu ){
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
                        "gender" => helpers::fieldValidation($_POST["gender"]),
                        "age" => helpers::fieldValidation($_POST["age"]),
                        "user_id" => $_SESSION["user"]["id"],
                        "status" => helpers::fieldValidation($_POST["status"]),
                        "passwordError" => false,
                        "permissionsArray" => $this->permissionsModel->getAll(),
                        "statusArray" => $this->statusModel->getAll(),
                    ];

                    if( $data["password"] == $data["password_validation"]){

                        if( $data["id"] == null ){
                            if( $this->permission->can_create ){
                                $execute = $this->userModel->insert($data);
                                if( !is_array($execute) ){
                                    helpers::redirecction("users");
                                }else{
                                    $data["error"] = $execute;
                                    $this->view("users/insert", $data);
                                }
                            }else{
                                $this->view("notfound/deneged");
                            }

                        } else{
                            if( $this->permission->can_update ) {
                                $execute = $this->userModel->update($data);
                                if( !is_array( $execute ) ){
                                    helpers::redirecction("users");
                                }else{
                                    $data["error"] = $execute;
                                    $this->view("users/insert", $data);
                                }
                            }
                            else{
                                $this->view("notfound/deneged");
                            }
                        }
                    }else{
                        $data["passwordError"] = true;
                        $data["permissionsArray"] = $this->permission->getAll();
                        $data["statusArray"] = $this->statusModel->getAll();

                        $this->view("users/insert", $data);
                    }

                }else if( ($id != null) && ( $_SERVER["REQUEST_METHOD"] != "POST" )){

                    /**
                     * Obtener info desde modelo
                     */

                    $user = $this->userModel->getUser(helpers::decrypt($id));
                    $data = [
                        "id" => $user->id,
                        "first_name" => $user->first_name,
                        "last_name" => $user->last_name,
                        "user" => $user->user,
                        "email" => $user->email,
                        "password" => $user->password,
                        "age" => $user->age,
                        "gender" => $user->gender,
                        "permissions" => $user->permissions_id,
                        "status" => $user->status_id,
                        "permissionsArray" => $this->permissionsModel->getAll(),
                        "statusArray" => $this->statusModel->getAll(),
                        "passwordError" => false
                    ];
                    if( helpers::canRead()) {
                        $this->view("users/insert", $data);
                    }else{
                        $this->view("notfound/deneged");
                    }

                }else{
                    $data = [
                        "id" => null,
                        "first_name" => "",
                        "last_name" => "",
                        "user" => "",
                        "email" => "",
                        "password" => "",
                        "age" => "",
                        "gender" => "",
                        "status" => "",
                        "permissions" => "",
                        "permissionsArray" => $this->permissionsModel->getAll(),
                        "statusArray" => $this->statusModel->getAll(),
                        "passwordError" => false
                    ];

                    $this->view("users/insert", $data);
                }
            }
            else {
                $this->view("notfound/deneged");
            }
        }

        public function delete($id){
            if( $this->permission->users_menu ){
                if( $this->permission->can_delete  && helpers::decrypt($id) != $_SESSION["user"]["id"] ) {
                    if( $id != null ){
                        $url = $_SERVER['HTTP_REFERER'];
                        $data = [
                            "id" => helpers::decrypt($id),
                            "deleted_by" => $_SESSION["user"]["id"]
                        ];
                        if( $this->userModel->delete($data)){
                            header("Location: ".$url);
                        }else{
                            $this->view("notfound/wrong");
                        }
                    }
                }else{
                    $this->view("notfound/deneged");
                }
            }else {
                $this->view("notfound/deneged");
            }

        }

        public function show( $id ){
            if( $this->permission->users_menu ){
                if( $this->permission->can_read ){
                    if( $id != null){
                        $user = $this->userModel->getUser( helpers::decrypt( $id ));
                        $data = [
                            "user" => $user,
                            "permissions" => $this->permissionsModel->getPermission($user->permissions_id),
                            "status" => $this->statusModel->getMainStatus($user->status_id),
                            "created_by" => $this->userModel->getUser($user->created_by),
                            "updated_by" => $this->userModel->getUser($user->updated_by)
                        ];
                        $this->view("users/show", $data);

                    }else{
                        $this->view("notfound/wrong");
                    }
                }
            }else {
                $this->view("notfound/deneged");
            }
        }
    }
