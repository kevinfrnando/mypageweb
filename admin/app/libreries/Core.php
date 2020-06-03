<?php

    /***
     *
     * Traer URL del navegador
     *
     */

    class Core{
        protected $currentController = "DashboardController";
        protected $notFound = "NotfoundController";
        protected $currentMethod = "index";
        protected $parameters = [];

        public function __construct (){
            $url = $this->getUrl();
            $controller = ucwords($url[0])."Controller";
            // Buscamos en controladores si existe
            if( file_exists("../app/controllers/".$controller.".php")){
                $this->currentController = $controller;
                // unset indice
                unset($url[0]);
            }else{
                $this->currentController = "NotfoundController";
            }

            require_once "../app/controllers/".$this->currentController.".php";
            $this->currentController = new $this->currentController;

            /**
             * Chequeamos si existe metodo
             */

            if( isset( $url[1] )){
                if( method_exists( $this->currentController,$url[1]) ){
                    $this->currentMethod = $url[1];
                    unset( $url[1]);
                }
            }

            /**
             *  Obtener parametros
             */
            $this->parameters = $url ? array_values($url) : [];
            call_user_func_array([$this->currentController, $this->currentMethod], $this->parameters);


        }

        public function getUrl(){
            if( isset($_GET["url"])){
                $url = rtrim($_GET["url"], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }
        }

    }
