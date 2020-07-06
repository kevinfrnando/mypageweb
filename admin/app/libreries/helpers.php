<?php
class helpers{
    private static $KeySuperSecret = "Peleo junto a sirenoman y chico perseve por la liertad de fondo de bikini";
    private static $method = "AES-256-CBC";
    private static $secretId = "0951193242";

    public static function encrypt ($string) {
        $output=FALSE;
        $key=hash('sha256', helpers::$KeySuperSecret);
        $iv=substr(hash('sha256', helpers::$secretId), 0, 16);
        $output=openssl_encrypt($string, helpers::$method, $key, 0, $iv);
        $output=base64_encode($output);
        return $output;
    }

    public static function decrypt ($string) {
        $key=hash('sha256', helpers::$KeySuperSecret);
        $iv=substr(hash('sha256',  helpers::$secretId), 0, 16);
        $output=openssl_decrypt(base64_decode($string), helpers::$method, $key, 0, $iv);
        return $output;
    }

    public static function fieldValidation($field){
        $field = trim($field);
        $field = stripcslashes($field);
        $field = htmlspecialchars($field);
        return $field;
    }

    public static function redirecction($path){
        header("location: "._URL.$path);
    }

    public static function getBrowser($user_agent){

        if(strpos($user_agent, 'MSIE') !== FALSE)
            return 'Internet explorer';
        elseif(strpos($user_agent, 'Edge') !== FALSE) //Microsoft Edge
            return 'Microsoft Edge';
        elseif(strpos($user_agent, 'Trident') !== FALSE) //IE 11
            return 'Internet explorer';
        elseif(strpos($user_agent, 'Opera Mini') !== FALSE)
            return "Opera Mini";
        elseif(strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR') !== FALSE)
            return "Opera";
        elseif(strpos($user_agent, 'Firefox') !== FALSE)
            return 'Mozilla Firefox';
        elseif(strpos($user_agent, 'Chrome') !== FALSE)
            return 'Google Chrome';
        elseif(strpos($user_agent, 'Safari') !== FALSE)
            return "Safari";
        else
            return 'No hemos podido detectar su navegador';
    }

    public static function getRealIP() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    public static function encryptPass( $pass ){
            $options = ['memory_cost' => 1<<10, 'time_cost' => 4, 'threads' => 2];
            return password_hash('$password', PASSWORD_ARGON2I);

    }

    public static function canCreate(){
        $permissions = $_SESSION["user"]["permissions"];

        return $permissions->can_create;
    }
    public static function canUpdate(){
        $permissions = $_SESSION["user"]["permissions"];

        return $permissions->can_update;
    }
    public static function canDelete(){
        $permissions = $_SESSION["user"]["permissions"];

        return $permissions->can_delete;
    }
    public static function canRead(){
        $permissions = $_SESSION["user"]["permissions"];

        return $permissions->can_read;
    }




}
?>