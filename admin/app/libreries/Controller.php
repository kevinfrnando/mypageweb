<?php

/**
 * Class Controller
 * Cargara vistas y modelos
 *
 */

class Controller{

    /**
     * Cargara Modelo
     */
    public function model($model){
        if( file_exists ( "../app/models/".$model.".php" ) ){

            require_once "../app/models/".$model.".php";


            return new $model();
        }
    }

    public function view( $view, $data = [] ){
        if( file_exists( "../app/views/".$view.".php") ){
            if($view != "components/login/index"){
                require_once _PARTIALS."header.php";
            }else{
                require_once _PARTIALS."headerLogin.php";
            }

            require_once "../app/views/".$view.".php";

            require_once _PARTIALS."footer.php";

        }else{
            require_once _PARTIALS."header.php";
            require_once "../app/views/notfound/index.php";
            require_once _PARTIALS."footer.php";

        }
    }

}
