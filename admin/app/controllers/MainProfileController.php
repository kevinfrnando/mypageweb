<?php
class MainProfileController extends Controller{

    public function __construct(){
        $this->main = $this->model("MainProfile");
        $this->path = "profile/mainprofile/";
    }
    public function index(){
        $data = $this->main->getData();
        $this->view($this->path."index", $data);
    }

    public function update(){
        if( $_SERVER["REQUEST_METHOD"] == "POST") {
            $data = [
                "id" =>  helpers::fieldValidation($_POST["id"]) ,
                "main_name" =>  helpers::fieldValidation($_POST["main_name"]) ,
                "main_legend" => helpers::fieldValidation($_POST["main_legend"]) ,
                "bio_title" =>   helpers::fieldValidation($_POST["bio_title"]) ,
                "bio_legend" =>   helpers::fieldValidation($_POST["bio_legend"]),
                "bio_profile" =>   helpers::fieldValidation($_POST["bio_profile"])
            ]   ;

            if( $this->main->update($data)){
                helpers::redirecction("mainprofile");
            }
        }

    }
}