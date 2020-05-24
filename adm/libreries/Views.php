<?php
    class Views{
        function render($controller, $view){
            $controllers = get_class($controller);

            if( $view == "index" ) {
                require _VIEWS._PARTIALS."headerIndex.php";
            }else{
                require _VIEWS._PARTIALS."header.php";
            }


            require _VIEWS.$controllers.'/'.$view.'.php';

            require _VIEWS._PARTIALS."footer.php";

        }
    }
?>