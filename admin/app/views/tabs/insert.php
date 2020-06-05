<div class="container-fluid">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4"><?php echo $data["id"] ? "Editar" : "Registrar "?> Usuario</h1>
                        </div>
                        <form class="user" action="<?php echo _URL."users/insert/".$data["id"];?>" method="POST">
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" value="<?php echo $data["first_name"]?>" class="form-control form-control-user" autofocus id="exampleFirstName" name="first_name" placeholder="Nombres">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text"  value="<?php echo $data["last_name"]?>"class="form-control form-control-user" id="exampleLastName" name="last_name" placeholder="Apellidos">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <input type="text" value="<?php echo $data["user"]?>" class="form-control form-control-user" id="user" name="user" placeholder="Usuario">
                                </div>
                                <div class="col-sm-8">
                                    <input type="email" value="<?php echo $data["email"]?>" class="form-control form-control-user" id="email" name="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="exampleFormControlSelect1">Estado</label>
                                    <select name="permissions" class="form-control form-control-user" id="exampleFormControlSelect1">
                                        <option value="1">Admin</option>
                                        <option value="1">Oher</option>
                                        <option value="1">Another</option>
                                        <option value="1">Root</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label for="exampleFormControlSelect1">Permisos</label>
                                    <select name="status" id="exampleFormControlSelect1">
                                        <option value="1">Admin</option>
                                        <option value="1">Oher</option>
                                        <option value="1">Another</option>
                                        <option value="1">Root</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" value="<?php echo $data["password"]?>" class="form-control form-control-user" id="exampleInputPassword" name="password" placeholder="Clave">
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" value="<?php echo $data["password"]?>" class="form-control form-control-user" id="exampleRepeatPassword" name="userPassValidation" placeholder="Repite la clave">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                <?php echo $data["id"] ? "Registrar" : "Actualiza"?>
                            </button>
                        </form>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

