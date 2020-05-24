<?php
    require "config.php";
    require "controllers/ErrorsController.php";
    $url = $_GET["url"] ?? "IndexController/index";
    $url = explode("/", $url);
    $controller = "";
    $method = "";

    $error = new ErrorsController();
    if( isset($url[0]) ){
        $controller = $url[0];
    }
    if( isset($url[1]) ){
       if( $url[1] != ''){
            $method = $url[1];
       }
    }
    spl_autoload_register( function ( $class ){
        if( file_exists(_LIBS.$class.".php")){
            require _LIBS.$class.".php";
        }
    });

    $controllersPath = "controllers/".$controller.".php";

    if( file_exists($controllersPath) ){
        require $controllersPath;
        $controller = new $controller();
        if( method_exists( $controller, $method) ){
            $controller->{$method}();
        }else{
            $error->error();
        }

    }else{
        $error->error();
    }


?>