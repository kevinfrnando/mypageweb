<?php


class SocialMediaController extends Controller{
    public function __construct(){
        $this->socialMedia = $this->model("SocialMedia");
        $this->statusModel = $this->model("MainStatus");
        $this->files = $this->model("Files");
        $this->userModel = $this->model("AuthUser");
        $sessionPermission = $_SESSION["user"]["permissions"];
        $this->permissionsModel = $this->model("AuthPermissions");
        $this->permission = $this->permissionsModel->getPermission( $sessionPermission->id );
        $this->path = "profile/socialmedia/";
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
            $rowCounts = $this->socialMedia->countRows()->count;
            $start = ( $i - 1) * $rowsPerPage;
            $totalTabs = ceil($rowCounts / $rowsPerPage);
            $socialMedia = $this->socialMedia->getData($start,$rowsPerPage);


            /**
             *  Obtenemos los ids de los registros corespondientes a los usuarios para luego obtenerlos en la consulta
             *
             */
            $usersId = [];
            $statusId = [];

            foreach ( $socialMedia as $media){
                array_push( $usersId, $media->created_by);
                array_push( $usersId, $media->updated_by == null ? 0 : $media->updated_by);
                array_push( $statusId, $media->status_id);
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
                "socialMedia"=> $socialMedia,
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
                    "url" => helpers::fieldValidation($_POST["url"]),
                    "profile_id" => 1,
                    "user_id" => $_SESSION["user"]["id"],
                    "status_id" => helpers::fieldValidation($_POST["status_id"])
                ];


                if( $data["id"] == null  ){
                    if( $this->permission->can_create ){
                        $name = "social_media";
                        $response = helpers::imageManagement($_FILES["image_url"], $name);
                        if( $response["error"] == null && $response["saved"] && $response["exception"] == null){
                            $data["folder_path"] = $response["path"];
                            $data["folder_name"] = $name;
                            $data["type"] = $response["type"];
                            $data["size"] = $response["size"];
                            $data["name"] = $name.$this->files->nextFile("social_media");
                            $this->files->insert($data);
                            $imgId = $this->files->getLastId();
                            $data["image_url"] = $imgId;

                            $execute = $this->socialMedia->insert($data);

                            if( !is_array($execute) ){
                                helpers::redirecction("socialMedia");
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
                        $execute = $this->socialMedia->update($data);

                        if( !is_array($execute) ){
                            helpers::redirecction("socialmedia");
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
                $socialMedia = $this->socialMedia->getSocialMedia( helpers::decrypt($id) );

                $data = [
                    "id" => $socialMedia->id,
                    "description" => $socialMedia->description,
                    "url" => $socialMedia->url,
                    "image_url" => $socialMedia->logo,
                    "status_id" => $socialMedia->status_id,
                    "statusArray" => $this->statusModel->getAll()
                ];

                $this->view($this->path."insert", $data);
            }else{

                $data = [
                    "id" => null,
                    "description" => "",
                    "url" => "",
                    "image_url" => "",
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
                    if( $this->socialMedia->delete($data)){
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