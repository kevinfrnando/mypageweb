<?php


include '../controller/auth_user_controller.php';
include "../helps/helps.php";

session_start();


header("Content-type: application/json; charset=utf-8");
$result = array("logged"=>false);

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(
        isset( $_POST["userName"]) &&
        isset( $_POST["userLastName"]) &&
        isset( $_POST["userEmail"]) &&
        isset( $_POST["userNick"]) &&
        isset( $_POST["userPermission"]) &&
        isset( $_POST["userPass"]) &&
        isset( $_POST["userPassValidation"])){


        $name = fieldValidation( $_POST["userName"] );
        $lastName = fieldValidation( $_POST["userLastName"] );
        $fullName = $name . " ".$lastName;
        $user = fieldValidation( $_POST["userNick"] );
        $email = fieldValidation( $_POST["userEmail"] );
        $pass = fieldValidation( $_POST["userPass"] );
        $createdBy = $_SESSION["user"]["id"];
        $createdOn = date('d-m-Y H:i:s');
        $updatedBy = $_SESSION["user"]["id"];
        $updatedOn = date('d-m-Y H:i:s');
        $permissions = fieldValidation( $_POST["userPermission"] );
        $status = fieldValidation( $_POST["userStatus"] );
        $passValidation = fieldValidation( $_POST["userPassValidation"] );
        $userId = null;
        if( isset($_POST["userId"])){
            $userId = is_null( $_POST["userId"] ) ? null: $_POST["userId"];

        }


        if( !is_null($userId)  ){
            if( auth_user_controller::registerUser( $userId, $name, $lastName, $fullName, $user, $email, $pass,  $createdBy, $createdOn, null, null, $permissions, $status )){
                header("location: ../view/allUsers.php");
            }
        }else{

            if( auth_user_controller::registerUser( null, $name, $lastName, $fullName, $user, $email, $pass,  null, null, $updatedOn, $updatedBy, $permissions, $status )){
                header("location: ../view/allUsers.php");
            }
        }


    }
}
//return print(json_encode($result));
//header("location: ../view/userRegister.php");