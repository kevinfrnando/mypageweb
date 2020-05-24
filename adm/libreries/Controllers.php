<?php

class Controllers {

    public function __construct(){
        $this->view = new Views();
        $this->loadClassModels();
    }

    public function loadClassModels(){
        $model = str_replace("Controller","", get_class($this));
        $path = 'models/'.$model.'.php';
        if( file_exists( $path ) ){
            require $path;
            $this->model = new $model();
        }
    }
}

?>