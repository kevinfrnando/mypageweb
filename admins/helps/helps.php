<?php
/**
 * Sanitize the field
 * @param $field
 * @return string
 *
 */

function fieldValidation($field){
    $field = trim($field);
    $field = stripcslashes($field);
    $field = htmlspecialchars($field);


    return $field;
}


?>