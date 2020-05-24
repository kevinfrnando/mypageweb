/**
 *
 * CODIGO DE USUARIOS
 *
 * **/

var user = new Users();

var loginUser = () => {
    var email = document.getElementById("auth_email").value;
    var pass = document.getElementById("auth_password").value;

    user.loginUser(email, pass);
}

$().ready(()=>{
})