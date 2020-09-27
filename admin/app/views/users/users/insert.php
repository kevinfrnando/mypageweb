<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row justify-content-between">
        <div class="col-sm-4 col-lg-6  col-md-6 col-xl-6 d-flex row">
            <a href="<?php echo _URL."users/insert"?>" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                          <i class="fa fa-plus"></i>
                        </span>
                <span class="text">Nuevo </span>
            </a>
        </div>
        <div class="col-sm-4 col-lg-6  col-md-6 col-xl-3  d-flex justify-content-end row">
            <a href="<?php echo _URL."users"?>" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                  <i class="fa fa-arrow-left"></i>
                </span>
                <span class="text text-truncate">Regresar al listado</span>
            </a>

        </div>
    </div>
    <br>
    <div class="card shadow mb-4">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4"><?php echo $data["id"] ? "Editar" : "Nuevo "?> Usuario</h1>
                        </div>
                        <div class="card-body col-lg-12 mx-auto">
                            <form action="<?php echo _URL."users/insert/".helpers::encrypt($data["id"]);?>" class="form-hor" method="post">
                                <input hidden type="text" name="id" value="<?php echo $data["id"]?>">
                                <?php if( isset($data["error"])){ var_dump($data["error"]);?>
                                    <div class="row alert alert-warning alert-dismissible fade show" role="alert">
                                        <div>
                                            <strong>Error!</strong> No se puede guardar <?php echo ($data["error"]["code"] == 23000 ? "por que ya existe un registro con campos únicos" : "Error Desconocido" )?><br>
                                            <strong>Description: </strong> <?php echo $data["error"]["message"]?><br>
                                            <strong>Código Sql: </strong> <?php echo $data["error"]["code"]?>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="row col-lg-12 ">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group row">
                                            <label for="inputMainName" class="text-truncate col-lg-4 col-form-label">Nombres</label>
                                            <input type="text" required value="<?php echo $data["first_name"]?>" class="form-control col-lg-8 col-sm-12" autofocus id="exampleFirstName" name="first_name" placeholder="Nombres">
                                            <!--                                <small id="mainNameHelp" class="form-text text-muted">Nombre que aparece en la página principal.</small>-->
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group row">
                                            <label for="inputMainName" class="text-truncate col-lg-4 col-form-label">Apellidos</label>
                                            <input type="text" required value="<?php echo $data["last_name"]?>"class="form-control col-lg-8 col-sm-12" id="exampleLastName" name="last_name" placeholder="Apellidos">
                                            <!--                                <small id="mainNameHelp" class="form-text text-muted">Nombre que aparece en la página principal.</small>-->
                                        </div>

                                    </div>
                                </div>

                                <div class="row col-lg-12">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group row">
                                            <label for="inputMainName" class="text-truncate col-lg-4 col-form-label">User</label>
                                            <input type="text" required value="<?php echo $data["user"]?>" class="form-control col-lg-8 col-sm-12" id="user" name="user" placeholder="Usuario">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group row">
                                            <label for="inputMainName" class="text-truncate col-lg-4 col-form-label">Correo</label>
                                            <input type="email" required value="<?php echo $data["email"]?>" class="form-control col-lg-8 col-sm-12" id="email" name="email" placeholder="Email">

                                        </div>
                                    </div>
                                </div>
                                <div class="row col-lg-12">
                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xl-3">
                                        <div class="form-group row">
                                            <label for="inputMainName" class="text-truncate col-lg-4 col-form-label">Clave</label>
                                            <input type="password" value="<?php echo $data["password"]?>" required class="form-control col-lg-8 col-sm-12" id="user" name="password" placeholder="Clave">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xl-3">
                                        <div class="form-group row">
                                            <label for="inputMainName" class="text-truncate col-lg-4 col-form-label">Repita </label>
                                            <input type="password" value="<?php echo $data["password"]?>" required class="form-control col-lg-8 col-sm-12" id="email" name="password_validation" placeholder="Repita Clave">

                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xl-3">
                                        <div class="form-group row">
                                            <label for="inputMainName" class="text-truncate col-lg-4 col-form-label">Edad: </label>
                                            <input type="number" min="1" max="99" value="<?php echo $data["age"]?>" class="form-control col-lg-8 col-sm-12" name="age">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xl-3 ">
                                        <div class="form-group row">
                                            <label for="inputMainName" class="text-truncate col-lg-4 col-form-label">Sexo: </label>
                                            <select class="form-control col-lg-8 col-sm-12" name="gender">
                                                <option value="1" <?php echo $data["gender"] == 1 ? "selected": ""?>> Masculino</option>
                                                <option value="2" <?php echo $data["gender"] == 2 ? "selected": ""?>> Femenino</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <?php if(  $data["passwordError"] ){ ?>
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong>Ups!</strong> Las claves no coinciden.
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </butto>
                                                </button>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="row col-lg-12">
                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xl-6 ">
                                        <div class="form-group row">
                                            <label for="inputMainLegend" class="text-truncate col-lg-4 col-form-label">Status</label>
                                            <select class="form-control col-lg-8 col-sm-12" name="status">
                                                <?php foreach ( $data["statusArray"] as $status) {?>
                                                    <option
                                                            value="<?php echo $status->id;?>"
                                                        <?php echo ($data["status"] == $status->id ? "selected": null) ?>>
                                                        <?php echo $status->description;?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xl-6 ">
                                        <div class="form-group row">
                                            <label for="inputMainLegend" class="text-truncate col-lg-4 col-form-label">Permisos</label>

                                            <select class="form-control col-lg-8 col-sm-12" name="permission">
                                                <?php foreach ( $data["permissionsArray"] as $permission) {?>
                                                    <option
                                                            value="<?php echo $permission->id;?>"
                                                        <?php echo ($data["permissions"] == $permission->id ? "selected": null) ?>>
                                                        <?php echo $permission->description;?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        <?php echo ($data["id"] ? "Actualizar" : "Registrar")?>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



