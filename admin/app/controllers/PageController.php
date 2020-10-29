<?php

spl_autoload_register( function ( $class ){
    if( file_exists( "../admin/app/models/".$class.".php" ) ){
        require_once "../admin/app/models/".$class.".php";
    }else if ( file_exists( require_once "../admin/app/libreries/".$class.".php" )){
        require_once "../admin/app/libreries/".$class.".php";
    }



} );

require_once "../admin/app/config/config.php";


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
        try {
            $tabs = new Tabs( self::$connection );
            $main = new MainProfile( self::$connection );
            $socialMedia = new SocialMedia( self::$connection );
            $skillsType = new SkillType( self::$connection );
            $skillsType = $skillsType->getPageSkillsType(1);
            $skills = new Skills( self::$connection );
            $experience = new Experience( self::$connection );
            $experienceDetail = new ExperienceDetail( self::$connection );
            $experienceArray = [];
            $formation = new Formation( self::$connection );
            $coversNav = new CoversNavs( self::$connection );
            $covers = new Covers( self::$connection );
            $testimonials = new Testimonials(self::$connection);
            $musicalProjects = new Projects( self::$connection );
            $about = new About( self::$connection );

            foreach ( $experience->getPageExperience( 1 ) as $obj ){

                $obj->details = $experienceDetail->getPageExperienceDetails( $obj->id);
                array_push( $experienceArray, $obj);
            }


            return [
                "profile" => $main->getProfileData( 1 ),
                "socialMedia" => $socialMedia->getPageSocialMedia(1),
                "skillsType" => $skillsType,
                "skills" => $skills->getPageSkills( $skillsType ),
                "tabs" => $tabs->getPageTabs(),
                "experience" => $experienceArray,
                "formation" => $formation->getPageFormation( 1 ),
                "coversNav" => $coversNav->getPageCoversNav( 1 ),
                "covers" => $covers->getPageCovers(),
                "testimonials" => $testimonials->getPageTestimonials( 1 ),
                "projects" => $musicalProjects->getPageProjects( 1 ),
                "about" => $about->getPageAbout( 1 )
            ];
        }catch ( Exception $e){

        }
    }
}