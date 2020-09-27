<?php


class AboutController extends Controller
{
    public function __construct(){
        $this->about = $this->model("About");
        $this->files = $this->model("Files");
        $this->statusModel = $this->model("MainStatus");
        $this->userModel = $this->model("AuthUser");
        $this->permissionsModel = $this->model("AuthPermissions");
        $sessionPermission = $_SESSION["user"]["permissions"];
        $this->permission = $this->permissionsModel->getPermission( $sessionPermission->id );
        $this->path = "aboutMe/about/";
    }
    public function index( $i = 1){

        if( $this->permission->about_menu) {
            $about = $this->about->getData();
            /**
             *  Obtenemos los ids de los registros corespondientes a los usuarios para luego obtenerlos en la consulta
             *
             *
             */
            $usersId = [];
            $statusId = [];
            $fileId = [];
            foreach ( $about as $abt){
                array_push( $usersId, $abt->created_by);
                array_push( $usersId, $abt->updated_by == null ? 0 : $abt->updated_by);
                array_push( $statusId, $abt->status_id);
                array_push( $fileId, $abt->image_url );
            }

            /**
             *  Construcion del parametro para las consultas SQL --- in () ---
             */
            $usersId = array_unique( $usersId );
            $statusId = array_unique( $statusId );
            $fileId = array_unique( $fileId );

            $usersId = implode(",", $usersId );
            $statusId = implode(",", $statusId );
            $fileId = implode(",", $fileId );

            $usersArray = $this->userModel->getUsersIn($usersId);
            $statusArray = $this->statusModel->getMainStatusIn($statusId);
            $fileArray = $this->files->getFilesIn($fileId);
            $data = [
                "about"=> $about,
                "statusArray" => $statusArray,
                "fileArray" => $fileArray,
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

        if( $this->permission->about_menu) {
            if( $_SERVER["REQUEST_METHOD"] == "POST") {
                $data = [
                    "id" => helpers::decrypt( $id ),
                    "description" => helpers::fieldValidation($_POST["description"]),
                    "profile_id" => 1,
                    "user_id" => $_SESSION["user"]["id"],
                    "status_id" => 1
                ];



                if( $data["id"] == null  ){
                    if( $this->permission->can_create ){
                        $folder = "about_me";
                        $name  = $folder.$this->files->nextFile($folder);
                        $response = helpers::imageManagement($_FILES["image_url"], $folder, $name);
                        if( $response["error"] == null && $response["saved"] && $response["exception"] == null){

                            $data["folder_path"] = $response["path"];
                            $data["folder_name"] = $folder;
                            $data["type"] = str_replace("image/",".",$response["type"]);
                            $data["size"] = $response["size"];
                            $data["name"] = $response["name"];
                            $this->files->insert($data);
                            $imgId = $this->files->getLastId();
                            $data["image_url"] = $imgId;

                            $execute = $this->about->insert($data);

                            if( !is_array($execute) ){
                                helpers::redirecction("about");
                            }else{
                                $data["error"] = $execute;
                                $data["statusArray"] = $this->statusModel->getAll();

                                $this->view($this->path."insert", $data);
                            }
                        }else{
                            $data["image_error"] = $response;
                            $data["statusArray"] = $this->statusModel->getAll();

                            $this->view($this->path."insert", $data);
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
                            $this->view($this->path."insert", $data);
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

                $this->view($this->path."insert", $data);
            }else{

                $data = [
                    "id" => null,
                    "description" => "",
                    "video_url" => "",
                    "statusArray" => $this->statusModel->getAll()
                ];

                $this->view($this->path."insert", $data);
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