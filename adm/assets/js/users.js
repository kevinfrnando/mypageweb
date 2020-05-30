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

                    $.post(
                        "Index/userLogin",
                        {
                            email, pass
                        },
                        (response)=>{
                            console.log(response);
                        }

                    );
                }else{
                    
                }
            }
        }
    }
    
}