<?php
class MainProfileController extends Controller{

    public function __construct(){
        $this->main = $this->model("MainProfile");
    }
    public function index(){
        $data = $this->main->getData();
        $this->view("mainprofile/index", $data);
    }
}