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

    public static function fieldArrayValidation($array){
        $fields = [];
        foreach ( $array as $field){
            $field = trim($field);
            $field = stripcslashes($field);
            $field = htmlspecialchars($field);
            array_push( $fields, $field);
        }

        return $fields;
    }

    public static function redirecction($path){
        header("location: "._URL.$path);
    }
    public static function connectionError( ){
        header("location: "._ERROR_PAGE);
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

    function getRealIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];

        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            return $_SERVER['HTTP_X_FORWARDED_FOR'];

        return $_SERVER['REMOTE_ADDR'];
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

    public function imageManagement( $image , $path , $name){

        $response = [
            "error" => null ,
            "saved" => false ,
            "message" => "",
            "exception" => null,
            "path" => $_SERVER["DOCUMENT_ROOT"]."/media/images/".$path."/"
            ];
        try {
            $image_name = $name.str_replace("image/",".",$image["type"]);
            $image_type = $image["type"];
            $image_size = $image["size"];

            $size = $image_size <= 6000000 ;
            $type = $image_type == "image/jpeg" || $image_type == "image/png" || $image_type == "image/jpg";


            $response["type"] = $image_type;
            $response["name"] = $image_name;
            $response["size"] = $image_size;
            if(  $size && $type ) {
                // Ruta carpeta Destino
                $folder = $response["path"];

                // Se verifica si existe

                if( ! file_exists( $folder )){
                    mkdir($folder, 0777, true);
                }
                if(! file_exists( $folder."large" )){
                    mkdir($folder."large", 0777, true);
                }
                if(! file_exists( $folder."medium" )){
                    mkdir($folder."medium", 0777, true);
                }
                if(! file_exists( $folder."micro" )){
                    mkdir($folder."micro", 0777, true);
                }
                if(! file_exists( $folder."original" )){
                    mkdir($folder."original", 0777, true);
                }
                if(! file_exists( $folder."small" )){
                    mkdir($folder."small", 0777, true);
                }

                $response["saved"] = helpers::redimention( $image, $path ,$image_name);


                // SE TRASLADA IMAGEN DEL DIR TEMPORAL A LA CARPETA INDICADA
                move_uploaded_file($_FILES["image_url"]["tmp_name"], $folder."original/".$image_name);
                return [];
            }else{
                if( $type == false ){
                    $response["message"] = "Solo se puede subir extensiones .jpg, .jpeg, y .png";
                }elseif ( $size == false){
                    $response["message"] = "Archivo Demasiado Grande";
                }
                $response["error"] = true;

            }
        }catch (Exception $e){
            $response["exception"] = $e->getMessage();
        } finally {
            return $response;
        }
    }

    public function redimention($img , $path, $name){
        try {
            $image_name = $name;
            $micro = null;
            $small = null;
            $medium = null;
            $large = null;

            $folder = $_SERVER["DOCUMENT_ROOT"]."/media/admin/images/".$path."/";


            /*
             *  CREATE IMAGE
             */
            $size = getimagesize($img["tmp_name"]);
            $ratio = $size[0]/$size[1]; // width/height
            if( $ratio > 1) {
                $micro = [50,50/$ratio];
                $small = [250,250/$ratio];
                $medium = [500,500/$ratio];
                $large = [800,800/$ratio];
            }
            else {
                $micro = [50*$ratio,50];
                $small = [250*$ratio,250];
                $medium = [500*$ratio,500];
                $large = [800*$ratio,800];
            }
            $src = imagecreatefromstring(file_get_contents($img["tmp_name"]));

            /*
             * FOR MICRO
             */
            $dstMicro = imagecreatetruecolor($micro[0],$micro[1]);
            imagecopyresampled($dstMicro,$src,0,0,0,0,$micro[0],$micro[1],$size[0],$size[1]);
            imagejpeg($dstMicro,$folder."micro/".$image_name);
            /*
             * FOR SMALL
             */
            $dstSmall = imagecreatetruecolor($small[0],$small[1]);
            imagecopyresampled($dstSmall,$src,0,0,0,0,$small[0],$small[1],$size[0],$size[1]);
            imagejpeg($dstSmall,$folder."small/".$image_name);
            /*
             * FOR MEDIUM
             */
            $dstMedium = imagecreatetruecolor($medium[0],$medium[1]);
            imagecopyresampled($dstMedium,$src,0,0,0,0,$medium[0],$medium[1],$size[0],$size[1]);
            imagejpeg($dstMedium,$folder."medium/".$image_name);
            /*
             * FOR LARGE
             */
            $dstLarge = imagecreatetruecolor($large[0],$large[1]);
            imagecopyresampled($dstLarge,$src,0,0,0,0,$large[0],$large[1],$size[0],$size[1]);
            imagejpeg($dstLarge,$folder."large/".$image_name);


            imagedestroy($src);
            imagedestroy($dstMicro);
            return true;
        }catch ( Exception $e){
            return false;
        }

    }


}
?>