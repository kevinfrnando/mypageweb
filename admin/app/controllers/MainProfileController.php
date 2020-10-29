<?php
class MainProfileController extends Controller{

    public function __construct(){
        $this->main = $this->model("MainProfile");
        $this->path = "profile/mainprofile/";
        $sessionPermission = $_SESSION["user"]["permissions"];
        $this->permissionsModel = $this->model("AuthPermissions");
        $this->permission = $this->permissionsModel->getPermission( $sessionPermission->id );
    }
    public function index(){
        $data = $this->main->getData();
        $this->view($this->path."index", $data);
    }

    public function update(){
        if( $_SERVER["REQUEST_METHOD"] == "POST") {
            if( $this->permission->profile_menu) {
                if( $this->permission->can_update ){
                    $data = [
                        "id" =>  helpers::fieldValidation($_POST["id"]) ,
                        "main_name" =>  helpers::fieldValidation($_POST["main_name"]) ,
                        "main_legend" => helpers::fieldValidation($_POST["main_legend"]) ,
                        "bio_title" =>   helpers::fieldValidation($_POST["bio_title"]) ,
                        "bio_legend" =>   helpers::fieldValidation($_POST["bio_legend"]),
                        "bio_profile" =>   helpers::fieldValidation($_POST["bio_profile"]),
                        "nationality" =>   helpers::fieldValidation($_POST["nationality"]),
                        "profession" =>   helpers::fieldValidation($_POST["profession"]),
                        "birthday" =>   helpers::fieldValidation($_POST["birthday"]),
                        "residency" =>   helpers::fieldValidation($_POST["residency"]),
                        "freelance" =>   helpers::fieldValidation($_POST["freelance"]),
                        "blood" =>   helpers::fieldValidation($_POST["blood"]),
                        "email" =>   helpers::fieldValidation($_POST["email"]),
                        "movil" =>   helpers::fieldValidation($_POST["movil"]),
                        "user_id" => $_SESSION["user"]["id"]
                    ]   ;

                    if( $this->main->update($data)){
                        helpers::redirecction("mainprofile");
                    }
                }
            }

        }

    }
}