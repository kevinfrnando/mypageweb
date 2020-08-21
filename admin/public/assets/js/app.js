
$(document).ready(function(){


    function filePreview( input ){
        if( input.files && input.files[0]){
            var reader = new FileReader();

            reader.onload = function( e ){
                $('#imagePreview').html("<img style='max-width: 300px; max-height: 312px; position: absolute;left: 0;top: 0;right: 0;bottom: 0;margin: auto;' src='"+e.target.result+"'/>")
            }
            reader.readAsDataURL( input.files[0] );
        }
    }

    $('#image_url').change( function () {
        var filename = $('input[type=file]').val().replace(/C:\\fakepath\\/i, '')
        $('#image_name_preview').html(filename)
       filePreview(this);
    });

    $('#RichText').richText({
        imageUpload: false,
        fileUpload: false,
        table: false,
        // title
        heading: false,

        // colors
        fontColor: false,
        fontSize : false,
        videoEmbed : false,
        fonts : false,
        maxlength: 1300,

    })


    $('#deleteModal').on('show.bs.modal', function( e ){
        var link = document.getElementById("deleteAnchor").getAttribute("href");
        var id = $(e.relatedTarget).data('id');
        var newLink = link+id;
        document.getElementById("deleteAnchor").href = newLink;
    });
    $( '#currentCheck' ).on( 'change', function() {
        if( $(this).is(':checked') ){
            $('#endExperience').prop('readonly', true);
            $('#endExperience').val('');

        } else {
            // Hacer algo si el checkbox ha sido deseleccionado
            $('#endExperience').prop('readonly', false);

        }
    });
    $('#experienceForm').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });

    $('#noDetails').click( function () {
        $( "#addDetail" ).prop( "checked", false );
    })
    $('#addDetails').click( function () {
        $( "#addDetail" ).prop( "checked", true );
    })
    $('#detailsExperienceModal').on('hidden.bs.modal', function (e) {
        $('#experienceForm').submit();
    })



    // Bind captura el evento, Click, Submit, etc
    // $("#loginForm").bind("submit", function () {
    //     $.ajax({
    //         type:$(this).attr("method"),
    //         url:$(this).attr("action"),
    //         data: $(this).serialize(),
    //         beforeSend : function(){
    //             $("#loginForm button[type=submit]").html("enviando...");
    //             $("#loginForm button[type=submit]").attr("disabled","disabled");
    //         },
    //         success: function ( response ) {
    //             if( response.logged == true){
    //                 $("body").overhang({
    //                     type: "success",
    //                     message: "Conectando! :D",
    //                     callback : function () {
    //                         window.location.href = "index.php"
    //                     }
    //                 });
    //             }else{
    //                 $("body").overhang({
    //                     type: "error",
    //                     message: "Opps... Credenciales incorrectas :(",
    //                     closeConfirm: true
    //                 });
    //             }
    //             $("#loginForm button[type=submit]").html("Ingresar");
    //             $("#loginForm button[type=submit]").removeAttr("disabled");
    //
    //         },
    //         error: function () {
    //             $("body").overhang({
    //                 type: "error",
    //                 message: "Opps... Algo salió mal :(",
    //                 closeConfirm: true
    //             });
    //             $("#loginForm button[type=submit]").html("Ingresar");
    //             $("#loginForm button[type=submit]").removeAttr("disabled");
    //         }
    //
    //     })
    //
    //     return false;
    // });

});