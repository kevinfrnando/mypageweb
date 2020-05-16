<?php


include '../controller/auth_user_controller.php';
include "../helps/helps.php";

session_start();


header("Content-type: application/json; charset=utf-8");
$result = array("logged"=>false);

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if( isset( $_POST["formEmail"]) && isset( $_POST["formPass"])){


        $email = fieldValidation( $_POST["formEmail"] );
        $pass = fieldValidation( $_POST["formPass"] );

        if( auth_user_controller::login($email, $pass)){
            $result["logged"] = true;
            $user = auth_user_controller::getUser($email, $pass);
            $user->getFullName();
            $_SESSION["user"] = array(
                "id" => $user->getId(),
                "firstName" => $user->getFirstName(),
                "lastName" => $user->getLastName(),
                "fullName" => $user->getFullName(),
                "status_id" => $user->getStatusId(),
                "last_ip" => $user->getLastIp(),
                "last_login" => $user->getLastLogin()
            );
        }

    }
}


return print(json_encode($result));
