<?php

class helpers{
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