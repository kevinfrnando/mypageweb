<?php


class NotfoundController extends Controller{
    public function index(){
        $this->view("notfound/index");
    }

    public function noAuthorized(){
        $this->view("notfound/deneged");
    }
    public function noConnection(){
        $this->view("notfound/noconected");
    }
}