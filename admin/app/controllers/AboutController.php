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
                    "video_url" => helpers::fieldValidation($_POST["video_url"]),
                    "title" => helpers::fieldValidation($_POST["title"]),
                    "image_url" => helpers::fieldValidation($_POST["image_url"]),
                    "profile_id" => 1,
                    "user_id" => $_SESSION["user"]["id"],
                    "status_id" => helpers::fieldValidation($_POST["status_id"])
                ];


                if( $data["id"] == null  ){
                    if( $this->permission->can_create ){
                        $execute = $this->projects->insert($data);

                        if( !is_array($execute) ){
                            helpers::redirecction("projects");
                        }else{
                            $data["error"] = $execute;
                            $data["statusArray"] = $this->statusModel->getAll();

                            $this->view("aboutMe/projects/insert", $data);
                        }
                    }else{
                        $this->view("notfound/deneged");
                    }



                }else{
                    if( $this->permission->can_update ){
                        $execute = $this->projects->update($data);

                        if( !is_array($execute) ){
                            helpers::redirecction("projects");
                        }else{
                            $data["error"] = $execute;
                            $data["statusArray"] = $this->statusModel->getAll();
                            $this->view("aboutMe/projects/insert", $data);
                        }
                    }
                }

            }else if( ($id != null) && ( $_SERVER["REQUEST_METHOD"] != "POST" )){
                /**
                 * Obtener info desde modelo
                 */
                $project = $this->projects->getProject( helpers::decrypt($id) );

                $data = [
                    "id" => $project->id,
                    "description" => $project->description,
                    "video_url" => $project->youtube_link,
                    "title" => $project->title,
                    "image_url" => $project->image_url,
                    "status_id" => $project->status_id,
                    "statusArray" => $this->statusModel->getAll()
                ];

                $this->view("aboutMe/projects/insert", $data);
            }else{

                $data = [
                    "id" => null,
                    "description" => "",
                    "video_url" => "",
                    "title" => "",
                    "image_url" => "",
                    "status_id" => "",
                    "statusArray" => $this->statusModel->getAll()
                ];

                $this->view("aboutMe/projects/insert", $data);
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