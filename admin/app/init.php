<?php
    /**
     *  Se cargaran librerias
     *
     */

    require_once "config/config.php";
    //echo __FILE__;

    //require_once "libreries/Connection.php";
    //require_once "libreries/Controller.php";
    //require_once "libreries/Core.php";

/**
 *
 * Los require's anteriores se reemplaza con la funcion que sigue
 *
 */

    //Autoload para las clases
    spl_autoload_register( function ( $class ){
        require_once "libreries/".$class.".php";
    } );