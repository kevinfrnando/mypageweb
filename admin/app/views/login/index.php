<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Kevin Vergara - Dashboard</title>

    <link href="../assets/vendor/fontawesome-free/css/all.css" rel="stylesheet">

    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">


    <link href="../assets/css/overhang.min.css" rel="stylesheet">

</head>


<body class="bg-gradient-primary">

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Bienvenido</h1>
                                </div>
                                <form class="user" action="<?php echo _URL."login/login";?>" id="loginForm" method="post">
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" required autofocus id="auth_email" aria-describedby="emailHelp" name="email" placeholder="Igresa tu email aqui">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" required id="auth_password" name="password" placeholder="Tu clave">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Recuerdame</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">

                                        Ingresar
                                    </button>
                                    <hr>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="forgot-password.html">Recuperar Clave?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        if( isset($data)){
                            echo "hola";
                        }
                    ?>
                </div>
            </div>

        </div>

    </div>

</div>


</body>

<!-- Bootstrap core JavaScript-->
<script src="../assets/vendor/jquery/jquery.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../assets/js/sb-admin-2.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>





<!-- AJAX JS -->
<script src="../assets/js/overhang.min.js"></script>
<script src="../assets/js/app.js"></script>


</html>
