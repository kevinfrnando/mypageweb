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
            <div class="row row col-lg-12">
                <div class="col-lg-12 mx-auto">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4"><?php echo $data["user"]->full_name ?></h1>
                        </div>
                        <div class="card-body col-lg-12 mx-auto">
                            <div class="row col-lg-12">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group row">
                                        <label for="inputMainName" class="text-truncate col-lg-4 col-form-label font-weight-bold">Nombres</label>
                                        <input readonly type="text" value="<?php echo $data["user"]->first_name?>" class="col-lg-8 col-sm-12 form-control-plaintext" autofocus id="exampleFirstName" name="first_name" placeholder="Nombres">
                                        <!--                                <small id="mainNameHelp" class="form-text text-muted">Nombre que aparece en la página principal.</small>-->
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group row">
                                        <label for="inputMainName" class="text-truncate col-lg-4 col-form-label font-weight-bold">Apellidos</label>
                                        <input readonly type="text"  value="<?php echo $data["user"]->last_name?>"class="col-lg-8 col-sm-12 form-control-plaintext " id="exampleLastName" name="last_name" placeholder="Apellidos">
                                        <!--                                <small id="mainNameHelp" class="form-text text-muted">Nombre que aparece en la página principal.</small>-->
                                    </div>

                                </div>
                            </div>
                            <div class="row col-lg-12">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group row ">
                                        <label for="inputMainName" class="text-truncate col-lg-4 col-form-label font-weight-bold">Nick</label>
                                        <input type="text" readonly value="<?php echo $data["user"]->user?>" class="col-lg-8 col-sm-12 form-control-plaintext " id="user" name="user" placeholder="Usuario">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group row ">
                                        <label for="inputMainName" class="text-truncate col-lg-4 col-form-label font-weight-bold">Correo</label>
                                        <input type="email" readonly value="<?php echo $data["user"]->email?>" class="col-lg-8 col-sm-12 form-control-plaintext " id="email" name="email" placeholder="Email">

                                    </div>
                                </div>
                            </div>
                            <div class="row col-lg-12">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group row ">
                                        <label for="inputMainName" class="text-truncate col-lg-4 col-form-label font-weight-bold">Edad</label>
                                        <input type="text" readonly value="<?php echo $data["user"]->age?>" class="col-lg-8 col-sm-12 form-control-plaintext " id="user" name="user" placeholder="Usuario">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group row ">
                                        <label for="inputMainName" class="text-truncate col-lg-4 col-form-label font-weight-bold">Sexo</label>
                                        <input type="email" readonly value="<?php echo $data["user"]->gender != 1 ? "Femenino" : "Masculino"?>" class="col-lg-8 col-sm-12 form-control-plaintext " id="email" name="email" placeholder="Email">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-success">Accesibilidad</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-row">
                                                <div class="form-group col-sm-12 col-md-6 ">
                                                    <div class="custom-control custom-checkbox">
                                                        <label class="form-check-label font-weight-bold" for="createCheck">
                                                            Status
                                                        </label>
                                                        <input class="form-control-plaintext" type="text" value="<?php echo $data["status"]->description ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12 col-md-6">
                                                    <div class="custom-control custom-checkbox">
                                                        <label class="form-check-label font-weight-bold" for="createCheck">
                                                            Permisos
                                                        </label>
                                                        <input class="form-control-plaintext" type="text" value="<?php echo $data["permissions"]->description ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-info">Ultimo Acceso</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-row">
                                                <div class="form-group col-sm-12 col-md-6">
                                                    <div class="custom-control custom-checkbox">
                                                        <label class="form-check-label font-weight-bold" for="createCheck">
                                                            Fecha
                                                        </label>
                                                        <input class="form-control-plaintext" type="text" value="<?php echo $data["user"]->last_login ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12 col-md-6">
                                                    <div class="custom-control custom-checkbox">
                                                        <label class="form-check-label font-weight-bold" for="createCheck">
                                                            IP
                                                        </label>
                                                        <input class="form-control-plaintext" type="text" value="<?php echo $data["user"]->last_ip ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Auditoría</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-row">
                                            <div class="form-group col-sm-12 col-md-12 col-lg-3">
                                                <div class="custom-control custom-checkbox">
                                                    <label class="form-check-label font-weight-bold" for="createCheck">
                                                        Fecha Creación
                                                    </label>
                                                    <input class="form-control-plaintext" type="text" value="<?php echo $data["user"]->created_on ?>">
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-12 col-md-12 col-lg-3">
                                                <div class="custom-control custom-checkbox">
                                                    <label class="form-check-label font-weight-bold" for="createCheck">
                                                        Creado Por
                                                    </label>
                                                    <input class="form-control-plaintext" type="text" value="<?php echo ( $data["created_by"] != null) ? $data["created_by"]->full_name : "" ?>">
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-12 col-md-12 col-lg-3">
                                                <div class="custom-control custom-checkbox">
                                                    <label class="form-check-label font-weight-bold" for="createCheck">
                                                        Ultima Edición
                                                    </label>
                                                    <input class="form-control-plaintext" type="text" value="<?php echo $data["user"]->updated_on ?>">
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-12 col-md-12 col-lg-3">
                                                <div class="custom-control custom-checkbox">
                                                    <label class="form-check-label font-weight-bold" for="createCheck">
                                                        Editado Por
                                                    </label>
                                                    <input class="form-control-plaintext" type="text" value="<?php echo ( $data["updated_by"] != null ) ? $data["updated_by"]->full_name : "" ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



