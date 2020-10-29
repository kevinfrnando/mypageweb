<?php

//
//    define("DB_HOST","localhost");
//    define("DB_USER","root");
//    define("DB_PASS","");
//    define("DB_NAME","karikum");

define("DB_HOST","161.97.124.87:3306");
define("DB_USER","kevinver_root");
define("DB_PASS","Romanos1202");
define("DB_NAME","kevinver_karikum");

    define("APP_NAME","ADMIN PAGE");

    // RUTAS DE LA APP
    define('_URL', 'http://localhost/mypageweb/admin/');
    define('_ERROR_PAGE', 'http://localhost/mypageweb/error.html');
    define("_MEDIA", dirname(dirname(dirname(dirname(dirname(__FILE__)) ))) )."media/";
    define("_ROOT", dirname(dirname(dirname(__FILE__)) ) );
    define("_ROUTE_APP", dirname(dirname(__FILE__)) );
    define("_ROUTE_PUBLIC", _ROOT."public/" );

    define('_CONFIG', _ROUTE_APP.'config/');
    define('_CONTROLLERS', _ROUTE_APP.'controllers/');
    define('_HELPERS', _ROUTE_APP.'helpers/');
    define('_LIBRERIES', _ROUTE_APP.'libreries/');
    define('_MODELS', _ROUTE_APP.'models/');
    define('_VIEWS', _ROUTE_APP.'views/');

    define('_PARTIALS', _ROUTE_APP."/views/partials/" );
    define('_ASSETS', _URL."public/assets/");





