<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between">
        <div class="col-sm-3 d-flex">
            <?php
            if( isset( $data["id"])){ ?>
                <a href="<?php echo _URL."experiencedetails/insert"?>" class="btn btn-primary btn-icon-split">
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
                            <h1 class="h4 text-gray-900 mb-4">Detalles</h1>
                        </div>
                        <div class="card-body col-lg-10 mx-auto">
                            <form action="<?php echo _URL."experiencedetail/insert/".helpers::encrypt($data["id"]);?>" method="post" id="experienceForm">
                                <input hidden type="text" name="id" value="<?php echo $data["id"]?>">
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
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group row ">
                                                    <label for="inputMainLegend" class="text-truncate col-sm-2 col-form-label">Descripción</label>
                                                    <input required type="text" class="form-control col-sm-10" id="description" name="description" aria-describedby="descriptionHelp" placeholder="Google">
                                                    <!--                                <small id="mainLegendHelp" class="form-text text-muted">Legenda que aparece en la página principal.</small>-->
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="row">
<!--                                    <a class="btn btn-primary btn-user btn-block" href="#" data-id="--><?php //echo helpers::encrypt($experience->id) ?><!--" data-toggle="modal" data-target="#detailsExperienceModal">--><?php //echo ($data["id"] ? "Actualizar" : "Registrar")?><!--</a>-->
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Guardar
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
