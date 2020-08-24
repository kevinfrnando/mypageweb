<?php


class AboutController extends Controller
{
    public function __construct(){
        $this->about = $this->model("About");
        $this->statusModel = $this->model("MainStatus");
        $this->userModel = $this->model("AuthUser");
        $this->permissionsModel = $this->model("AuthPermissions");
        $sessionPermission = $_SESSION["user"]["permissions"];
        $this->permission = $this->permissionsModel->getPermission( $sessionPermission->id );
    }
    public function index( $i = 1){

        if( $this->permission->about_menu) {
            $this->view("aboutMe/about/index");
        }else {
            $this->view("notfound/deneged");
        }
    }
    public function insert( $id = null ){

        if( $this->permission->about_menu) {
            if( $_SERVER["REQUEST_METHOD"] == "POST") {
                $data = [
                    "id" => helpers::decrypt( $id ),
                    "description" => helpers::fieldValidation($_POST["description"]),
                    "image_url" => "",
                    "profile_id" => 1,
                    "user_id" => $_SESSION["user"]["id"]
                ];
                var_dump($_POST);

                $response = helpers::imageManagement($_FILES["image_url"], "about");

                if( $data["id"] == null  ){
                    if( $this->permission->can_create ){
                        $execute = $this->about->insert($data);

                        if( !is_array($execute) ){
                            helpers::redirecction("projects");
                        }else{
                            $data["error"] = $execute;
                            $data["statusArray"] = $this->statusModel->getAll();

                            $this->view("aboutMe/about/insert", $data);
                        }
                    }else{
                        $this->view("notfound/deneged");
                    }



                }else{
                    if( $this->permission->can_update ){
                        $execute = $this->about->update($data);

                        if( !is_array($execute) ){
                            helpers::redirecction("aboutme");
                        }else{
                            $data["error"] = $execute;
                            $data["statusArray"] = $this->statusModel->getAll();
                            $this->view("aboutMe/about /insert", $data);
                        }
                    }
                }

            }else if( ($id != null) && ( $_SERVER["REQUEST_METHOD"] != "POST" )){
                /**
                 * Obtener info desde modelo
                 */
                $project = $this->about->getProject( helpers::decrypt($id) );

                $data = [
                    "id" => $project->id,
                    "description" => $project->description,
                    "video_url" => $project->youtube_link,
                    "statusArray" => $this->statusModel->getAll()
                ];

                $this->view("aboutMe/projects/insert", $data);
            }else{

                $data = [
                    "id" => null,
                    "description" => "",
                    "video_url" => "",
                    "statusArray" => $this->statusModel->getAll()
                ];

                $this->view("aboutMe/about/insert", $data);
            }
        }else {
            $this->view("notfound/deneged");
        }


    }
    public function delete($id){
        if( $this->permission->about_menu) {
            if( $this->permission->can_delete ){
                if( $id != null ){
                    $url = $_SERVER['HTTP_REFERER'];
                    $data = [
                        "id" => helpers::decrypt($id),
                        "deleted_by" => $_SESSION["user"]["id"]
                    ];
                    if( $this->projects->delete($data)){
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