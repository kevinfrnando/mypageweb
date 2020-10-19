<?php


class ExperienceController extends Controller
{
    public function __construct(){
        $this->experience = $this->model("Experience");
        $this->experienceDetails = $this->model("ExperienceDetail");
        $this->statusModel = $this->model("MainStatus");
        $this->userModel = $this->model("AuthUser");
        $sessionPermission = $_SESSION["user"]["permissions"];
        $this->permissionsModel = $this->model("AuthPermissions");
        $this->permission = $this->permissionsModel->getPermission( $sessionPermission->id );
        $this->path = "formation/experience/";
    }

    public function index( $i = 1){

        if( $this->permission->formation_menu) {
            /**
             *  Paginacion
             *  1.- Se obtiene el numero de registros
             *  2.- Se estalece el inicio con el indice pasado por parametro, por default sera el 1
             *  3.- Se divide para obtener la cantidad de tabs por todos los registros
             *
             */
            $rowsPerPage = 5;
            $rowCounts = $this->experience->countRows()->count;
            $start = ( $i - 1) * $rowsPerPage;
            $totalTabs = ceil($rowCounts / $rowsPerPage);
            $experience = $this->experience->getData($start,$rowsPerPage);


            /**
             *  Obtenemos los ids de los registros corespondientes a los usuarios para luego obtenerlos en la consulta
             *
             *
             */
            $usersId = [];
            $statusId = [];
            foreach ( $experience as $exp){
                array_push( $usersId, $exp->created_by);
                array_push( $usersId, $exp->updated_by == null ? 0 : $exp->updated_by);
                array_push( $statusId, $exp->status_id);
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
                "experience"=> $experience,
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

        if( $this->permission->formation_menu) {
            if( $_SERVER["REQUEST_METHOD"] == "POST") {
                $addDetails = isset( $_POST["addDetail"] );
                $data = [
                    "id" => helpers::decrypt( $id ),
                    "detailsId" => isset( $_POST["detailsId"] ) ? helpers::fieldArrayValidation($_POST["detailsId"]) : [],
                    "detailsDescription" => isset($_POST["detailsName"]) ? helpers::fieldArrayValidation($_POST["detailsName"]) : [],
                    "title" => helpers::fieldValidation($_POST["title"]),
                    "company" => helpers::fieldValidation($_POST["company"]),
                    "current" => isset( $_POST["current"] ),
                    "start" => helpers::fieldValidation($_POST["start"]),
                    "end" => helpers::fieldValidation($_POST["end"]),
                    "profile_id" => 1,
                    "user_id" => $_SESSION["user"]["id"],
                    "status_id" => helpers::fieldValidation($_POST["status_id"])
                ];

                if( $data["id"] == null  ){
                    if( $this->permission->can_create ){
                        $execute = $this->experience->insert($data);
                        if( !is_array($execute) ){
                            $experience = $this->experience->lastInsert()->LastId;

                            $error = false;
                            foreach ( $data["detailsDescription"] as $description){
                                $detail = [
                                    "description" => $description,
                                    "experienceId" => $experience,
                                    "user_id" => $_SESSION["user"]["id"],
                                    "status_id" => 1
                                ];

                                $executeDetail = $this->experienceDetails->insert( $detail );
                            }
                            helpers::redirecction("experience");
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
                        $execute = $this->experience->update($data);
                        if( !is_array($execute) ){
                            if( count( $data["detailsId"] ) > 0 ){

                                if( count( $data["detailsId"] ) == count( $data["detailsDescription"] ) ){
                                    $keys = array_keys($data["detailsId"]);
                                    $ids = [];
                                    foreach($keys as $detailId){
                                        $id = $data["detailsId"][$detailId];
                                        if( $id > 0){
                                            array_push( $ids, $id);
                                        }
                                        $descriptionDetail = $data["detailsDescription"][$detailId];
                                        $detail = [
                                            "id" => $id,
                                            "description" => $descriptionDetail,
                                            "experienceId" => $data["id"],
                                            "user_id" => $_SESSION["user"]["id"],
                                            "status_id" => 1
                                        ];
                                        $executeDetail = $this->experienceDetails->update( $detail );
                                    }
                                    $ids = implode(",", $ids );
                                    $detailNotIn = [
                                        "experience_id" => $data["id"],
                                        "user_id" => $data["user_id"],
                                        "ids" => $ids
                                    ];

                                    if( $ids != "0"){
                                        $executeDetail = $this->experienceDetails->deleteIn( $detailNotIn );
                                    }
                                }elseif ( count( $data["detailsId"] ) < count( $data["detailsDescription"] ) ){
                                    $keys = array_keys($data["detailsDescription"]);

                                    $keysId = array_keys($data["detailsId"]);
                                    $ids = [];
                                    foreach($keysId as $detailId){
                                        $id = $data["detailsId"][$detailId];
                                        if( $id > 0){
                                            array_push( $ids, $id);
                                        }
                                    }
                                    $ids = implode(",", $ids );
                                    $detailNotIn = [
                                        "experience_id" => $data["id"],
                                        "user_id" => $data["user_id"],
                                        "ids" => $ids
                                    ];
                                    if( $ids != 0 ){
                                        $executeDetail = $this->experienceDetails->deleteIn( $detailNotIn );
                                    }
                                    foreach($keys as $_description){
                                        $id = isset($data["detailsId"][$_description]) ? $data["detailsId"][$_description] : null ;

                                        $descriptionDetail = $data["detailsDescription"][$_description];
                                        $detail = [
                                            "id" => $id,
                                            "description" => $descriptionDetail,
                                            "experienceId" => $data["id"],
                                            "user_id" => $_SESSION["user"]["id"],
                                            "status_id" => 1
                                        ];

                                        $executeDetail = $id == null ? $this->experienceDetails->insert( $detail ) : $this->experienceDetails->update( $detail );
                                    }

                                }

                            }else{
                                if( count( $data["detailsId"] ) == 0 && count( $data["detailsDescription"] ) == 0){
                                    $detailNotIn = [
                                        "experience_id" => $data["id"],
                                        "user_id" => $data["user_id"],
                                        "ids" => "0"
                                    ];
                                    $executeDetail = $this->experienceDetails->deleteIn( $detailNotIn );
                                }
                                foreach ( $data["detailsDescription"] as $description){
                                    $detail = [
                                        "description" => $description,
                                        "experienceId" => $data["id"],
                                        "user_id" => $_SESSION["user"]["id"],
                                        "status_id" => 1
                                    ];

                                    $executeDetail = $this->experienceDetails->insert( $detail );
                                }
                            }
                            helpers::redirecction("experience");
                        }else{
                            $data["error"] = $execute;
                            $data["statusArray"] = $this->statusModel->getAll();

                            $this->view($this->path."insert", $data);
                        }


                    }
                }

            }else if( ($id != null) && ( $_SERVER["REQUEST_METHOD"] != "POST" )){
                /**
                 * Obtener info desde modelo
                 */
                $experience = $this->experience->getExperience( helpers::decrypt($id) );

                $data = [
                    "id" => $experience->id,
                    "company" => $experience->company_name,
                    "start" => $experience->date_start,
                    "current" => $experience->current_experience,
                    "end" => $experience->date_end,
                    "title" => $experience->title,
                    "status_id" => $experience->status_id,
                    "details" => $this->experienceDetails->getData( $experience->id ),
                    "statusArray" => $this->statusModel->getAll()
                ];

                $this->view($this->path."insert", $data);
            }else{

                $data = [
                    "id" => null,
                    "company" => "",
                    "start" => "",
                    "current" => "",
                    "end" => "",
                    "title" => "",
                    "status_id" => "",
                    "details" => [],
                    "statusArray" => $this->statusModel->getAll()
                ];

                $this->view($this->path."insert", $data);
            }
        }else {
            $this->view("notfound/deneged");
        }


    }
    public function delete($id){
        if( $this->permission->profile_menu) {
            if( $this->permission->can_delete ){
                if( $id != null ){
                    $url = $_SERVER['HTTP_REFERER'];
                    $data = [
                        "id" => helpers::decrypt($id),
                        "deleted_by" => $_SESSION["user"]["id"]
                    ];
                    if( $this->experience->delete($data)){
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