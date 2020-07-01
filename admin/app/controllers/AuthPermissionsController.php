<?php


class AuthPermissionsController extends Controller {

    public function __construct(){
        $this->permission = $this->model("AuthPermissions");
        $this->users = $this->model("AuthUser");
    }

    public function index ( $i = 1){

        /**
         *  PAGINATION
         */
        $recordsPerPage = 5;
        $rowCounts = $this->permission->countRows()->count;
        $start = ($i -1) * $recordsPerPage;
        $totalRows = ceil( $rowCounts / $recordsPerPage);

        $permissionsArray = $this->permission->getData($start , $recordsPerPage);

        /**
         *  Users
         *
         */

        $usersId = [];
        foreach ( $permissionsArray as $permisions){
            array_push( $usersId, $permisions->created_by);
        }
        /**
         *  Construcion del parametro para las consultas SQL --- in () ---
         */
        $usersId = array_unique( $usersId );

        $usersId = implode(",", $usersId );

        $usersArray = $this->users->getUsersIn($usersId);
        $data = [
            "permissions" => $permissionsArray,
            "totalRows" => $totalRows,
            "current" => $i,
            "users" => $usersArray
        ];

        $this->view("permissions/index", $data);
    }

    public function insert( $id = null ){
        if( $_SERVER["REQUEST_METHOD"] == "POST") {
            $data = [
                "id" => helpers::decrypt( $id ),
                "code" => helpers::fieldValidation($_POST["code"]),
                "description" => helpers::fieldValidation($_POST["description"]),
                "read" => isset( $_POST["read"] ),
                "create" => isset( $_POST["create"] ) ,
                "delete" => isset( $_POST["delete"] ),
                "update" => isset( $_POST["update"] ) ,
                "user_id" => $_SESSION["user"]["id"]
            ];

            if( $data["id"] == null ){
                $execute = $this->permission->insert($data);
                if( !is_array($execute) ){
                    helpers::redirecction("authpermissions");
                }else{
                    $data["error"] = $execute;
                    $this->view("permissions/insert", $data);
                }


            }else{
                $execute = $this->permission->update($data);

                if( !is_array($execute) ){
                    helpers::redirecction("tabs");
                }else{
                    $data["error"] = $execute;
                        $this->view("permissions/insert", $data);
                }
            }

        }else if( ($id != null) && ( $_SERVER["REQUEST_METHOD"] != "POST" )){

            /**
             * Obtener info desde modelo
             */

            $permission= $this->permission->getPermission( helpers::decrypt($id));
            $data = [
                "id" => $permission->id,
                "code" => $permission->code,
                "description" => $permission->description,
                "can_delete" => $permission->can_delete,
                "can_create" => $permission->can_create,
                "can_update" => $permission->can_update,
                "can_read" => $permission->can_read,
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
            ];

            $this->view("permissions/insert", $data);
        }
    }

    public function delete ( $id ){
        if( $id != null ){
            $url = $_SERVER['HTTP_REFERER'];
            $data = [
                "id" => helpers::decrypt($id),
                "deleted_by" => $_SESSION["user"]["id"]
            ];
            if( $this->permission->delete($data)){
                header("Location: ".$url);
            }else{
                die("Algo salio mal");
            }
        }
    }
}