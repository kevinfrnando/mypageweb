<?php


class SkillsController extends Controller
{
    public function __construct(){
        $this->skills = $this->model("Skills");
        $this->skillType = $this->model("SkillType");
        $this->statusModel = $this->model("MainStatus");
        $this->userModel = $this->model("AuthUser");
        $sessionPermission = $_SESSION["user"]["permissions"];
        $this->permissionsModel = $this->model("AuthPermissions");
        $this->permission = $this->permissionsModel->getPermission( $sessionPermission->id );
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
            $rowCounts = $this->skills->countRows()->count;
            $start = ( $i - 1) * $rowsPerPage;
            $totalTabs = ceil($rowCounts / $rowsPerPage);
            $skills = $this->skills->getData($start,$rowsPerPage);


            /**
             *  Obtenemos los ids de los registros corespondientes a los usuarios para luego obtenerlos en la consulta
             *
             */
            $usersId = [];
            $statusId = [];
            $skillsTypeId = [];
            foreach ( $skills as $skill){
                array_push( $usersId, $skill->created_by);
                array_push( $usersId, $skill->updated_by == null ? 0 : $skill->updated_by);
                array_push( $statusId, $skill->status_id);
                array_push( $skillsTypeId, $skill->type_skills_id);
            }

            /**
             *  Construcion del parametro para las consultas SQL --- in () ---
             */
            $usersId = array_unique( $usersId );
            $statusId = array_unique( $statusId );
            $skillsTypeId = array_unique( $skillsTypeId );

            $usersId = implode(",", $usersId );
            $statusId = implode(",", $statusId );
            $skillsTypeId = implode(",", $skillsTypeId );

            $usersArray = $this->userModel->getUsersIn($usersId);
            $statusArray = $this->statusModel->getMainStatusIn($statusId);
            $skillsTypeArray = $this->skillType->getSkillsTypeIn($statusId);

            $data = [
                "skills"=> $skills,
                "statusArray" => $statusArray,
                "skillsTypeArray" => $statusArray,
                "totalTabs" => $totalTabs,
                "current" => $i,
                "permissions" => $this->permission,
                "usersArray" => $usersArray
            ];
            $this->view("skills/index", $data);
        }else {
            $this->view("notfound/deneged");
        }
    }
    public function insert( $id = null ){

        if( $this->permission->profile_menu) {
            if( $_SERVER["REQUEST_METHOD"] == "POST") {
                $data = [
                    "id" => helpers::decrypt( $id ),
                    "code" => helpers::fieldValidation($_POST["code"]),
                    "description" => helpers::fieldValidation($_POST["description"]),
                    "percentage" => helpers::fieldValidation($_POST["percentage"]),
                    "skills_type_id" => helpers::fieldValidation($_POST["skills_type_id"]),
                    "profile_id" => 1,
                    "user_id" => $_SESSION["user"]["id"],
                    "status_id" => helpers::fieldValidation($_POST["status_id"])
                ];


                if( $data["id"] == null  ){
                    if( $this->permission->can_create ){
                        $execute = $this->skills->insert($data);

                        if( !is_array($execute) ){
                            helpers::redirecction("skills");
                        }else{
                            $data["error"] = $execute;
                            $data["statusArray"] = $this->statusModel->getAll();                            $data["skillsTypeArray"] = $this->skillType->getAll();
                            $data["skillsTypeArray"] = $this->skillType->getAll();

                            $this->view("skills/insert", $data);
                        }
                    }else{
                        $this->view("notfound/deneged");
                    }



                }else{
                    if( $this->permission->can_update ){
                        $execute = $this->skills->update($data);

                        if( !is_array($execute) ){
                            helpers::redirecction("skills");
                        }else{
                            $data["error"] = $execute;
                            $data["statusArray"] = $this->statusModel->getAll();
                            $data["skillsTypeArray"] = $this->skillType->getAll();

                            $this->view("skills/insert", $data);
                        }
                    }
                }

            }else if( ($id != null) && ( $_SERVER["REQUEST_METHOD"] != "POST" )){

                /**
                 * Obtener info desde modelo
                 */

                $skills = $this->skills->getSkillType( helpers::decrypt($id) );

                $data = [
                    "id" => $skills->id,
                    "code" => $skills->code,
                    "description" => $skills->description,
                    "status_id" => $skills->status_id,
                    "statusArray" => $this->statusModel->getAll(),
                    "skillsTypeArray" => $this->skillType->getAll()

                ];

                $this->view("skills/insert", $data);
            }else{

                $data = [
                    "id" => null,
                    "code" => "",
                    "description" => "",
                    "status_id" => "",
                    "skills_type_id" => "",
                    "statusArray" => $this->statusModel->getAll(),
                    "skillsTypeArray" => $this->skillType->getAll()
                ];

                $this->view("skills/insert", $data);
            }
        }else {
            $this->view("notfound/deneged");
        }


    }

}