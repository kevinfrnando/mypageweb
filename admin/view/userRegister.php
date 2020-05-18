
<?php
include 'partials/header.php';
?>
<!-- Page Wrapper -->
    <!-- Content Wrapper -->
        <!-- Main Content -->
<div class="container-fluid">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Registrar Usuario!</h1>
                        </div>
                        <form class="user" action="../functions/registerUser.php" method="POST">
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" autofocus id="exampleFirstName" name="userName" placeholder="Nombres">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-user" id="exampleLastName" name="userLastName" placeholder="Apellidos">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <input type="text" class="form-control form-control-user" id="exampleLastName" name="userNick" placeholder="Usuario">
                                </div>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail" name="userEmail" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="exampleFormControlSelect1">Estado</label>
                                    <select name="userPermission" class="form-control form-control-user" id="exampleFormControlSelect1">
                                        <option value="1">Admin</option>
                                        <option value="1">Oher</option>
                                        <option value="1">Another</option>
                                        <option value="1">Root</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label for="exampleFormControlSelect1">Permisos</label>
                                    <select name="userStatus" class="form-control form-control-user" id="exampleFormControlSelect1">
                                        <option value="1">Admin</option>
                                        <option value="1">Oher</option>
                                        <option value="1">Another</option>
                                        <option value="1">Root</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="userPass" placeholder="Clave">
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" name="userPassValidation" placeholder="Repite la clave">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Registro!
                            </button>
                        </form>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
include 'partials/footer.php';
?>
