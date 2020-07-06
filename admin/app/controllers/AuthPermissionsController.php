<?php


class AuthPermissionsController extends Controller {

    public function __construct(){
        $this->permissionsModel = $this->model("AuthPermissions");
        $this->usersModel = $this->model("AuthUser");
        $this->statusModel = $this->model("MainStatus");
        $sessionPermission = $_SESSION["user"]["permissions"];
        $this->permission = $this->permissionsModel->getPermission( $sessionPermission->id );

    }

    public function index ( $i = 1){

        if( $this->permission->users_menu){
            /**
             *  PAGINATION
             */
            $recordsPerPage = 5;
            $rowCounts = $this->permissionsModel->countRows()->count;
            $start = ($i -1) * $recordsPerPage;
            $totalTabs = ceil( $rowCounts / $recordsPerPage);

            $permissionsArray = $this->permissionsModel->getData($start , $recordsPerPage);

            /**
             *  Users
             *
             */

            $usersId = [];
            $statusId = [];
            foreach ( $permissionsArray as $permissions){
                array_push( $usersId, $permissions->created_by);
                array_push( $usersId, $permissions->updated_by == null ? 0 : $permissions->updated_by);
                array_push( $statusId, $permissions->status_id);
            }
            /**
             *  Construcion del parametro para las consultas SQL --- in () ---
             */
            $usersId = array_unique( $usersId );
            $statusId = array_unique( $statusId );

            $usersId = implode(",", $usersId );
            $statusId = implode(",", $statusId );

            $usersArray = $this->usersModel->getUsersIn($usersId);
            $statusArray = $this->statusModel->getMainStatusIn($statusId);

            $data = [
                "permissions" => $permissionsArray,
                "statusArray" => $statusArray,
                "totalTabs" => $totalTabs,
                "current" => $i,
                "users" => $usersArray
            ];

            $this->view("permissions/index", $data);
        }else {
            $this->view("notfound/deneged");
        }
    }

    public function insert( $id = null ){

        if( $this->permission->users_menu){
            if( $_SERVER["REQUEST_METHOD"] == "POST") {
                $data = [
                    "id" => helpers::decrypt( $id ),
                    "code" => helpers::fieldValidation($_POST["code"]),
                    "description" => helpers::fieldValidation($_POST["description"]),
                    "status_id" => helpers::fieldValidation($_POST["status_id"]),
                    "can_read" => isset( $_POST["read"] ),
                    "can_create" => isset( $_POST["create"] ) ,
                    "can_delete" => isset( $_POST["delete"] ),
                    "can_update" => isset( $_POST["edit"] ) ,
                    "dashboard_menu" => isset( $_POST["dashboard_menu"] ) ,
                    "profile_menu" => isset( $_POST["profile_menu"] ) ,
                    "formation_menu" => isset( $_POST["formation_menu"] ) ,
                    "about_menu" => isset( $_POST["about_menu"] ) ,
                    "users_menu" => isset( $_POST["users_menu"] ) ,
                    "components_menu" => isset( $_POST["components_menu"] ) ,
                    "user_id" => $_SESSION["user"]["id"]
                ];

                if( $data["id"] == null ){
                    if( $this->permission->can_create ){
                        $execute = $this->permissionsModel->insert($data);
                        if( !is_array($execute) ){
                            helpers::redirecction("authpermissions");
                        }else{
                            $data["error"] = $execute;
                            $this->view("permissions/insert", $data);
                        }
                    }
                }else{
                    if( $this->permission->can_update ){
                        $execute = $this->permissionsModel->update($data);

                        if( !is_array($execute) ){
                            helpers::redirecction("authpermissions");
                        }else{
                            $data["error"] = $execute;
                            $this->view("permissions/insert", $data);
                        }
                    }

                }

            }else if( ($id != null) && ( $_SERVER["REQUEST_METHOD"] != "POST" )){

                /**
                 * Obtener info desde modelo
                 */

                $permission= $this->permissionsModel->getPermission( helpers::decrypt($id));
                $data = [
                    "id" => $permission->id,
                    "code" => $permission->code,
                    "description" => $permission->description,
                    "can_delete" => $permission->can_delete,
                    "can_create" => $permission->can_create,
                    "can_update" => $permission->can_update,
                    "can_read" => $permission->can_read,
                    "dashboard_menu" => $permission->dashboard_menu ,
                    "profile_menu" => $permission->profile_menu ,
                    "formation_menu" => $permission->formation_menu ,
                    "about_menu" => $permission->about_menu ,
                    "users_menu" => $permission->users_menu ,
                    "components_menu" => $permission->components_menu,
                    "status_id" => $permission->status_id,
                    "statusArray" => $this->statusModel->getAll()
                ];
                $this->view("permissions/insert", $data);
            }else{

                $data = [
                    "id" => null,
                    "code" => "",
                    "description" => "",
                    "can_delete" => "",
                    "can_create" => "",
                    "can_update" => "",
                    "can_read" => "",
                    "dashboard_menu" => "" ,
                    "profile_menu" => "" ,
                    "formation_menu" => "",
                    "about_menu" => "" ,
                    "users_menu" => "" ,
                    "components_menu" => "",
                    "status_id" => "",
                    "statusArray" => $this->statusModel->getAll()
                ];

                $this->view("permissions/insert", $data);
            }
        }else {
            $this->view("notfound/deneged");
        }


    }

    public function delete ( $id ){
        if( $this->permission->users_menu){
            if ( $this->permission->can_delete ) {
                if( $id != null ){
                    $url = $_SERVER['HTTP_REFERER'];
                    $data = [
                        "id" => helpers::decrypt($id),
                        "deleted_by" => $_SESSION["user"]["id"]
                    ];
                    if( $this->permissionsModel->delete($data)){
                        header("Location: ".$url);
                    }else{
                        die("Algo salio mal");
                    }
                }
            }
        }else {
            $this->view("notfound/deneged");
        }


    }
}