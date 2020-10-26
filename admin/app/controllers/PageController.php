<?php

spl_autoload_register( function ( $class ){
    if( file_exists( "../admin/app/models/".$class.".php" ) ){
        require_once "../admin/app/models/".$class.".php";
    }else if ( file_exists( require_once "../admin/app/libreries/".$class.".php" )){
        require_once "../admin/app/libreries/".$class.".php";
    }



} );

require_once "../admin/app/config/config.php";
//require_once "../admin/app/libreries/Connection.php";


class PageController
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbName = DB_NAME;
    private static $connection;

    public function __construct(){

        $getConnection = new Connection();
        self::$connection = $getConnection->connect();

    }

    public function getData(){
        $tabs = new Tabs( self::$connection );
        $main = new MainProfile( self::$connection );
        $socialMedia = new SocialMedia( self::$connection );
        $skillsType = new SkillType( self::$connection );
        $skillsType = $skillsType->getPageSkillsType(1);
        $skills = new Skills( self::$connection );

        return [
            "profile" => $main->getProfileData( 1 ),
            "socialMedia" => $socialMedia->getPageSocialMedia(1),
            "skillsType" => $skillsType,
            "skills" => $skills->getPageSkills( $skillsType ),
            "tabs" => $tabs->getPageTabs()
        ];
    }
}