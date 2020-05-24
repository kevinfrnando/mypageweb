<?php
    class Views{
        function render($controller, $view){
            $controllers = get_class($controller);

            require _VIEWS._PARTIALS."header.php";

            require _VIEWS.$controllers.'/'.$view.'.php';

            require _VIEWS._PARTIALS."footer.php";

        }
    }
?>