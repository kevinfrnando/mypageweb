<?php


include '../controller/auth_user_controller.php';
include "../helps/helps.php";

session_start();


header("Content-type: application/json; charset=utf-8");
$result = array("logged"=>false);

if($_SERVER["REQUEST_METHOD"] == "POST"){
    echo "Entro";
    if(
        isset( $_POST["userName"]) &&
        isset( $_POST["userLastName"]) &&
        isset( $_POST["userEmail"]) &&
        isset( $_POST["userNick"]) &&
        isset( $_POST["userPermission"]) &&
        isset( $_POST["userPass"]) &&
        isset( $_POST["userPassValidation"])){
        echo "isset";

        $name = fieldValidation( $_POST["userName"] );
        $lastName = fieldValidation( $_POST["userLastName"] );
        $email = fieldValidation( $_POST["userEmail"] );
        $user = fieldValidation( $_POST["userNick"] );
        $permissions = fieldValidation( $_POST["userPermission"] );
        $pass = fieldValidation( $_POST["userPass"] );
        $status = fieldValidation( $_POST["userStatus"] );
        $now = date('d-m-Y H:i:s');
        $createdBy = $_SESSION["user"]["id"];
        $passValidation = fieldValidation( $_POST["userPassValidation"] );
        $fullName = $name . " ".$lastName;

        if( auth_user_controller::registerUser($name, $lastName, $fullName, $user, $email, $pass,  $createdBy, $now, $permissions, $status )){
            header("location: ../view/index.php");
        }

    }
}
//return print(json_encode($result));
header("location: ../view/userRegister.php");