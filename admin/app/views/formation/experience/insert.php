<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between">
        <div class="col-sm-3 d-flex">
            <?php
            if( isset( $data["id"])){ ?>
                <a href="<?php echo _URL."experience/insert"?>" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                          <i class="fa fa-plus"></i>
                        </span>
                    <span class="text">Nuevo </span>
                </a>
            <?php } ?>

        </div>
        <div class="col-sm-3 d-flex justify-content-end">
            <a href="<?php echo _URL."experience"?>" class="btn btn-success btn-icon-split">
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
                <div class="col-lg-12 mx-auto">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4"><?php echo $data["id"] ? "Editar" : "Registrar "?> Experiencia</h1>
                        </div>
                        <div class="card-body col-lg-10 mx-auto">
                            <form action="<?php echo _URL."experience/insert/".helpers::encrypt($data["id"]);?>" method="post" id="experienceForm">
                                <input hidden type="text" name="id" value="<?php echo $data["id"]?>">
                                <input hidden id="addDetail"  type="checkbox" name="addDetail">
                                <?php if( isset($data["error"])){ ?>
                                    <div class="row alert alert-warning alert-dismissible fade show" role="alert">
                                        <div>
                                            <strong>Error!</strong> No se puede guardar <?php echo ($data["error"]["code"] == 23000 ? "por que ya existe un registro con este Código" : "Error Desconocido" )?>
                                            <p><strong>Código Sql: </strong> <?php echo $data["error"]["code"]?></p>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="row">
                                    <div class="col">
                                        <div class="row col-lg-12 ">
                                            <div class="col-lg-10 col-md-10">
                                                <div class="form-group row ">
                                                    <label class="text-truncate col-sm-4 col-form-label">Empresa</label>
                                                    <input required type="text" class="form-control col-sm-8" id="main_legend" name="company" value="<?php echo $data["company"]?>" placeholder="Google">
                                                    <!--                                <small id="mainLegendHelp" class="form-text text-muted">Legenda que aparece en la página principal.</small>-->
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="current" <?php echo $data["current"] == 1 ? "checked": "" ?> id="currentCheck">
                                                    <label class="form-check-label" for="currentCheck">Actual</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row form-gr col-sm-12">
                                            <label class="text-truncate col-lg-4 col-sm-4 col-form-label">Title</label>
                                            <input required type="text" class="form-control col-lg-8 col-sm-8" id="main_legend" name="title" value="<?php echo $data["title"]?>" placeholder="Developer">
                                            <!--                                <small id="mainLegendHelp" class="form-text text-muted">Legenda que aparece en la página principal.</small>-->
                                        </div>



                                        <div class="row col-lg-12 ">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group row">
                                                    <label for="inputMainName" class="text-truncate col-lg-4 col-form-label">Inicio</label>
                                                    <input type="date" required  class="form-control col-lg-8 col-sm-12" autofocus id="exampleFirstName" value="<?php echo $data["start"]?>" name="start">
                                                    <!--                                <small id="mainNameHelp" class="form-text text-muted">Nombre que aparece en la página principal.</small>-->
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group row">
                                                    <label for="inputMainName" class="text-truncate col-lg-4 col-form-label">Fin</label>
                                                    <input type="date" required <?php echo $data["current"] == 1 ? "readonly": "" ?> class="form-control col-lg-8 col-sm-12" id="endExperience" value="<?php echo $data["end"]?>" name="end">
                                                    <!--                                <small id="mainNameHelp" class="form-text text-muted">Nombre que aparece en la página principal.</small>-->
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group row form-gr col-sm-12">
                                            <label class="col-sm-4 col-form-label">Status</label>
                                            <select class="form-control form-control-sm form-control col-sm-8" name="status_id">
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

                                <div class="row col-lg-12">
                                    <div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="row">
                                                    <div class="col-lg-11 col-md-11">
                                                        <h5>Actividades</h5>
                                                    </div>
                                                    <div class="col-lg-1 col-md-1">
                                                        <button type="button" class="btn btn-sm btn-info addExperienceDetail"><span class="icon"><i class="fa fa-plus"></i></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body activitiesContent">
                                                <?php foreach ( $data["details"] as $detail) { ?>
                                                    <div id="experiencesActivities" class="form-group row wrapperExperience">
                                                        <div class="row col-sm-12">
                                                            <div class="col col-lg-11 col-md-11">
                                                                <input hidden type="text" value="<?php echo $detail->id?>" class="form-control form-control-sm col-sm-12" name="detailsId[]">
                                                                <input required type="text" value="<?php echo $detail->description?>" class="form-control form-control-sm col-sm-12" name="detailsName[]">
                                                            </div>
                                                            <div class="col col-lg-1 col-md-1">
                                                                <button type="button" class="btn btn-sm btn-danger deleteButtonJs"><span class="icon"><i class="fa fa-times"></i></span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
<!--                                    <a class="btn btn-primary btn-user btn-block" href="#" data-id="--><?php //echo helpers::encrypt($experience->id) ?><!--" data-toggle="modal" data-target="#detailsExperienceModal">--><?php //echo ($data["id"] ? "Actualizar" : "Registrar")?><!--</a>-->
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

<!-- Tabs Delete Modal -->
<div class="modal small fade" id="detailsExperienceModal" tabindex="-1" role="dialog" aria-labelledby="detailsExperienceModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Un paso más...</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Despues de <strong><?php echo ($data["id"] ? "Actualizar" : "Agregar")?></strong> este registro deseas <strong><?php echo ($data["id"] ? "Agregar, quitar o editar" : "Agregar" )?></strong> detalles?</div>
            <div class="modal-footer">
                <button id="noDetails" class="btn btn-primary" type="button" data-dismiss="modal">Solo Guardar</button>
                <button id="addDetails" class="btn btn-success" type="button" data-dismiss="modal">Agregar Detalles</button>
            </div>
        </div>
    </div>
</div>

