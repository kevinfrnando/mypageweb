<?php


class ExperienceController extends Controller
{
    public function __construct(){
        $this->experience = $this->model("Experience");
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
                    "code" => helpers::fieldValidation($_POST["code"]),
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
                            if( $addDetails ){
                                $parent = $this->experience->lastInsert()->LastId;
                                $this->view("experiencedetails/insert", $parent);
                            }else{
                                helpers::redirecction("experience");
                            }
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
                    "code" => $experience->code,
                    "company" => $experience->company_name,
                    "start" => $experience->date_start,
                    "current" => $experience->current_experience,
                    "end" => $experience->date_end,
                    "title" => $experience->title,
                    "status_id" => $experience->status_id,
                    "statusArray" => $this->statusModel->getAll()
                ];

                $this->view($this->path."insert", $data);
            }else{

                $data = [
                    "id" => null,
                    "code" => "",
                    "company" => "",
                    "start" => "",
                    "current" => "",
                    "end" => "",
                    "title" => "",
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