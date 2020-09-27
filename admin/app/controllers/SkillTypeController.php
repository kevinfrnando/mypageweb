<?php


class SkillTypeController extends Controller
{
    public function __construct(){
        $this->skillType = $this->model("SkillType");
        $this->statusModel = $this->model("MainStatus");
        $this->userModel = $this->model("AuthUser");
        $sessionPermission = $_SESSION["user"]["permissions"];
        $this->permissionsModel = $this->model("AuthPermissions");
        $this->permission = $this->permissionsModel->getPermission( $sessionPermission->id );
        $this->path = "profile/skillsType/";
    }

    public function index( $i = 1){

        if( $this->permission->profile_menu) {
            /**
             *  Paginacion
             *  1.- Se obtiene el numero de registros
             *  2.- Se estalece el inicio con el indice pasado por parametro, por default sera el 1
             *  3.- Se divide para obtener la cantidad de tabs por todos los registros
             *
             */
            $rowsPerPage = 5;
            $rowCounts = $this->skillType->countRows()->count;
            $start = ( $i - 1) * $rowsPerPage;
            $totalTabs = ceil($rowCounts / $rowsPerPage);
            $skillType = $this->skillType->getData($start,$rowsPerPage);


            /**
             *  Obtenemos los ids de los registros corespondientes a los usuarios para luego obtenerlos en la consulta
             *
             */
            $usersId = [];
            $statusId = [];
            foreach ( $skillType as $type){
                array_push( $usersId, $type->created_by);
                array_push( $usersId, $type->updated_by == null ? 0 : $type->updated_by);
                array_push( $statusId, $type->status_id);
            }

            /**
             *  Construcion del parametro para las consultas SQL --- in () ---
             */
            $usersId = array_unique( $usersId );
            $statusId = array_unique( $statusId );

            $usersId = implode(",", $usersId );
            $statusId = implode(",", $statusId );

            $usersArray = $this->userModel->getUsersIn($usersId);
            $statusArray = $this->statusModel->getMainStatusIn($statusId);

            $data = [
                "type"=> $skillType,
                "statusArray" => $statusArray,
                "totalTabs" => $totalTabs,
                "current" => $i,
                "permissions" => $this->permission,
                "usersArray" => $usersArray
            ];
            $this->view($this->path."index", $data);
        }else {
            $this->view("notfound/deneged");
        }
    }
    public function insert( $id = null ){

        if( $this->permission->profile_menu) {
            if( $_SERVER["REQUEST_METHOD"] == "POST") {
                $data = [
                    "id" => helpers::decrypt( $id ),
                    "description" => helpers::fieldValidation($_POST["description"]),
                    "user_id" => $_SESSION["user"]["id"],
                    "status_id" => helpers::fieldValidation($_POST["status_id"])
                ];


                if( $data["id"] == null  ){
                    if( $this->permission->can_create ){
                        $execute = $this->skillType->insert($data);

                        if( !is_array($execute) ){
                            helpers::redirecction("skillType");
                        }else{
                            $data["error"] = $execute;
                            $data["statusArray"] = $this->statusModel->getAll();
                            $this->view($this->path."insert", $data);
                        }
                    }else{
                        $this->view("notfound/deneged");
                    }



                }else{
                    if( $this->permission->can_update ){
                        $execute = $this->skillType->update($data);

                        if( !is_array($execute) ){
                            helpers::redirecction("skillType");
                        }else{
                            $data["error"] = $execute;
                            $data["statusArray"] = $this->statusModel->getAll() ;
                            $this->view($this->path."insert", $data);
                        }
                    }
                }

            }else if( ($id != null) && ( $_SERVER["REQUEST_METHOD"] != "POST" )){

                /**
                 * Obtener info desde modelo
                 */

                $type = $this->skillType->getSkillType( helpers::decrypt($id) );

                $data = [
                    "id" => $type->id,
                    "description" => $type->description,
                    "status_id" => $type->status_id,
                    "statusArray" => $this->statusModel->getAll()
                ];

                $this->view($this->path."insert", $data);
            }else{

                $data = [
                    "id" => null,
                    "description" => "",
                    "status_id" => "",
                    "statusArray" => $this->statusModel->getAll()
                ];

                $this->view($this->path."insert", $data);
            }
        }else {
            $this->view("notfound/deneged");
        }


    }

    public function delete($id){

        if( $this->permission->components_menu) {
            if( $this->permission->can_delete ){
                if( $id != null ){
                    $url = $_SERVER['HTTP_REFERER'];
                    $data = [
                        "id" => helpers::decrypt($id),
                        "deleted_by" => $_SESSION["user"]["id"]
                    ];
                    if( $this->skillType->delete($data)){
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