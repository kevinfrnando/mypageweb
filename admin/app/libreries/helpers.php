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



}
?>