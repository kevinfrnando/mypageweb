$(document).ready(function(){

    // Bind captura el evento, Click, Submit, etc
    $("#loginForm").bind("submit", function () {
        $.ajax({
            type:$(this).attr("method"),
            url:$(this).attr("action"),
            data: $(this).serialize(),
            beforeSend : function(){
                $("#loginForm button[type=submit]").html("enviando...");
                $("#loginForm button[type=submit]").attr("disabled","disabled");
            },
            success: function ( response ) {
                if( response.logged == true){
                    $("body").overhang({
                        type: "success",
                        message: "Conectando! :D",
                        callback : function () {
                            window.location.href = "index.php"
                        }
                    });
                }else{
                    $("body").overhang({
                        type: "error",
                        message: "Opps... Credenciales incorrectas :(",
                        closeConfirm: true
                    });
                }
                $("#loginForm button[type=submit]").html("Ingresar");
                $("#loginForm button[type=submit]").removeAttr("disabled");

            },
            error: function () {
                $("body").overhang({
                    type: "error",
                    message: "Opps... Algo salió mal :(",
                    closeConfirm: true
                });
                $("#loginForm button[type=submit]").html("Ingresar");
                $("#loginForm button[type=submit]").removeAttr("disabled");
            }

        })

        return false;
    });
});