<?php
class DashboardController extends Controller{

    public function __construct(){
        $this->model("Dashboard");
    }
    public function index(){
        $permissions = $_SESSION["user"]["permissions"];
        if( $permissions->dashboard_menu){
            $this->view("dashboard/index");
        }else{
            $this->view("notfound/deneged");
        }
    }
}