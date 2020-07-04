<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between">
        <div class="col-sm-3 d-flex">
            <?php
            if( isset( $data["id"])){ ?>
                <a href="<?php echo _URL."authpermissions/insert"?>" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                          <i class="fa fa-plus"></i>
                        </span>
                    <span class="text">Nuevo </span>
                </a>
            <?php } ?>

        </div>
        <div class="col-sm-3 d-flex justify-content-end">
            <a href="<?php echo _URL."authpermissions"?>" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                  <i class="fa fa-arrow-left"></i>
                </span>
                <span class="text">Regresar </span>
            </a>

        </div>
    </div>
    <br>

    <div class="card shadow mb-4">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4"><?php echo $data["id"] ? "Editar" : "Nuevo "?> Permiso</h1>
                        </div>
                        <div class="card-body col-lg-12 mx-auto">
                            <form action="<?php echo _URL."authpermissions/insert/".helpers::encrypt($data["id"]);?>" method="post">
                                <input hidden type="text" name="id" value="<?php echo $data["id"]?>">
                                <?php
                                if( isset($data["error"])){ ?>
                                    <div class="row alert alert-warning alert-dismissible fade show" role="alert">
                                        <div>
                                            <strong>Error!</strong> No se puede guardar <?php echo ($data["error"]["code"] == 23000 ? "por que ya existe un registro con este Código" : "Error Desconocido" )?>
                                            <p><strong>Código Sql: </strong> <?php echo $data["error"]["code"]?></p>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group row form-gr col-sm-12"">
                                            <label for="inputMainLegend" class="col-sm-4 col-form-label">Descripción</label>
                                            <input required type="text" class="form-control col-sm-8" id="main_legend" name="description" aria-describedby="descriptionHelp" value="<?php echo $data["description"]?>" placeholder="Descripción">
                                            <!--                                <small id="mainLegendHelp" class="form-text text-muted">Legenda que aparece en la página principal.</small>-->
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row form-gr col-sm-12"">
                                            <label for="inputMainName" class="col-sm-4 col-form-label">Code</label>
                                            <input required type="text" class="form-control col-sm-8 " id="main_name" name="code" aria-describedby="codeHelp" value="<?php echo $data["code"]?>" placeholder="Código">
                                            <!--                                <small id="mainNameHelp" class="form-text text-muted">Nombre que aparece en la página principal.</small>-->
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row form-gr col-sm-12"">
                                            <label for="inputMainName" class="col-sm-4 col-form-label">Status</label>
                                            <select class="form-control col-sm-8" name="status_id">
                                                <?php foreach ( $data["statusArray"] as $status) {?>
                                                    <option
                                                        value="<?php echo $status->id;?>"
                                                        <?php echo ($data["status_id"] == $status->id ? "selected": null) ?>>
                                                        <?php echo $status->description;?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div>
                                    <div>
                                        <div class="col">
                                            <div class="card shadow mb-4">
                                                <div class="card-header py-3">
                                                    <h6 class="m-0 font-weight-bold text-success">Accesibilidad</h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-row">
                                                        <div class="form-group col-sm-3">
                                                            <div class="custom-control custom-checkbox">
                                                                <label class="form-check-label" for="createCheck">
                                                                    Crear
                                                                </label>
                                                                <input class="form-check-input" id="createCheck" type="checkbox" data-toggle="toggle" data-size="xs" <?php echo $data["can_create"] == 1 ? "checked": "" ?> name="create">
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-sm-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label" for="gridRadios1">
                                                                    Leer
                                                                </label>
                                                                <input class="form-check-input" type="checkbox" data-toggle="toggle" data-size="xs" <?php echo $data["can_read"] == 1 ? "checked": "" ?> name="read">
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-sm-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label" for="gridRadios1">
                                                                    Editar
                                                                </label>
                                                                <input class="form-check-input" type="checkbox" data-toggle="toggle" data-size="xs" <?php echo $data["can_update"] == 1 ? "checked": "" ?> name="edit">
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-sm-3">
                                                            <div class="form-check" onclick="">
                                                                <label class="form-check-label" for="deleteCheck">
                                                                    Eliminar
                                                                </label>
                                                                <input class="form-check-input" id="deleteCheck" type="checkbox" data-toggle="toggle" data-size="xs" <?php echo $data["can_delete"] == 1 ? "checked": "" ?> name="delete">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card shadow mb-4">
                                                <div class="card-header py-3">
                                                    <h6 class="m-0 font-weight-bold text-primary">Menús</h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" id="customRadioDashboard" name="dashboard_menu" <?php echo $data["dashboard_menu"] == 1 ? "checked": "" ?> class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadioDashboard">Dashboard</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" id="customRadioProfile" name="profile_menu" <?php echo $data["profile_menu"] == 1 ? "checked": "" ?> class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadioProfile">Perfil</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" id="customRadioInlineFormation" name="formation_menu" <?php echo $data["formation_menu"] == 1 ? "checked": "" ?> class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadioInlineFormation">Formación</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" id="customRadioInlineAbout" name="about_menu" <?php echo $data["about_menu"] == 1 ? "checked": "" ?> class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadioInlineAbout">Sobre mí</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" id="customRadioInlineUsers" name="users_menu" <?php echo $data["users_menu"] == 1 ? "checked": "" ?> class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadioInlineUsers">Usuarios</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" id="customRadioInlineComponents" name="components_menu" <?php echo $data["components_menu"] == 1 ? "checked": "" ?> class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadioInlineComponents">Componentes</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        <?php echo ($data["id"] ? "Actualizar" : "Guardar")?>
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

