<?php

    class IndexController extends Controllers {
        public function __construct(){
            parent::__construct();
        }
        public function index(){
            $this->view->render($this, "index");
        }
    }

?>