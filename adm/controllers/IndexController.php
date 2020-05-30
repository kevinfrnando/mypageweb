<?php

    class IndexController extends Controllers {
        public function __construct(){
            parent::__construct();
        }
        public function index(){
            $this->view->render($this, "index");
        }
        public function userLogin(){
            if( isset($_POST["email"]) && isset($_POST["pass"])){
                echo $_POST["email"];
            }
        }
    }

?>