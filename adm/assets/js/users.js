class Users {
    constructor() {

    }

    loginUser(email, pass){
        if( email === ""){
           // alert("Requerido");
            document.getElementById("email").focus();
            M.toast({ html : "Enter email" , classes : 'rounded'})
       }else{
            if(pass =""){

            }else{
                if( validarEmail(email)){

                }else{
                    
                }
            }
        }
    }
    
}