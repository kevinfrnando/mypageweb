<?php
class DashboardController extends Controller{

    public function __construct(){
        $this->model("Dashboard");
    }
    public function index(){
        $this->view("dashboard/index");
    }
}