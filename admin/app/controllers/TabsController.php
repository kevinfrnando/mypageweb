<?php


class TabsController extends Controller
{
    public function __construct(){
        $this->tab = $this->model("Tabs");
    }

    public function index(){
        $tabs = $this->tab->getData();
        $data = [
            "tabs"=> $tabs
        ];
        $this->view("tabs/index", $data);
    }

}