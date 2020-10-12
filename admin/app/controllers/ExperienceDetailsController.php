<?php


class ExperienceDetailsController extends Controller
{
    public function __construct(){
        $this->experienceDetail = $this->model("ExperienceDetail");
        $this->experience = $this->model("Experience");
        $this->statusModel = $this->model("MainStatus");
        $this->userModel = $this->model("AuthUser");
        $sessionPermission = $_SESSION["user"]["permissions"];
        $this->permissionsModel = $this->model("AuthPermissions");
        $this->permission = $this->permissionsModel->getPermission( $sessionPermission->id );
        $this->path = "formation/experienceDetails/";
    }

    public function add( $id = null ){

        if( $this->permission->formation_menu) {
            if( $_SERVER["REQUEST_METHOD"] == "POST") {
                $data = [
                    "id" => helpers::decrypt( $id )
                ];


                if( $data["id"] == null  ){
                    if( $this->permission->can_create ){
                        $execute = $this->experience->insert($data);

                        if( !is_array($execute) ){
                            helpers::redirecction("formation/experience");
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

                            $this->view("formation/experience/insert", $data);
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

                $this->view("formation/experience/insert", $data);
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

                $this->view("formation/experience/insert", $data);
            }
        }else {
            $this->view("notfound/deneged");
        }


    }

    public function insert( $id = null ){

        if( $this->permission->formation_menu) {
            $data = [
                "parentId" => helpers::decrypt($id)
            ];
            if( $data["parentId"] == null  ) {

                    $this->view($this->path."insert", $data);
            }
        }else{
            $this->view("notfound/deneged");
        }
    }
}