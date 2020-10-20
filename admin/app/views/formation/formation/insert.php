<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between">
        <div class="col-sm-3 d-flex">
            <?php
            if( isset( $data["id"])){ ?>
                <a href="<?php echo _URL."formation/insert"?>" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                          <i class="fa fa-plus"></i>
                        </span>
                    <span class="text">Nuevo </span>
                </a>
            <?php } ?>

        </div>
        <div class="col-sm-3 d-flex justify-content-end">
            <a href="<?php echo _URL."formation"?>" class="btn btn-success btn-icon-split">
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
                            <h1 class="h4 text-gray-900 mb-4"><?php echo $data["id"] ? "Editar" : "Registrar "?> Experiencia Académica</h1>
                        </div>
                        <div class="card-body col-lg-12 mx-auto">
                            <form action="<?php echo _URL."formation/insert/".helpers::encrypt($data["id"]);?>" method="post">
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

                                        <div class="form-group row form-gr col-sm-12">
                                            <label for="inputMainLegend" class="col-sm-4 col-form-label">Titulo</label>
                                            <input required type="text" class="form-control col-sm-8" id="main_titulo" name="title" value="<?php echo $data["title"]?>" placeholder="Ingeniero">
                                        </div>
                                        <div class="form-group row form-gr col-sm-12">
                                            <label for="inputMainLegend" class="col-sm-4 col-form-label">Instituto</label>
                                            <input required type="text" class="form-control col-sm-8" id="main_titulo" name="institute" value="<?php echo $data["institute"]?>" placeholder="Instituto de la Mancha">
                                        </div>
                                        <div class="row col-lg-12 ">
                                            <div class="col-lg-4 col-md-4">
                                                <select class="custom-select" name="type" id="inputGroupSelect01">
                                                    <option selected>Escoja...</option>
                                                    <option <?php if($data["type"]) echo "selected";?> value="1">Curso</option>
                                                    <option <?php if(!$data["type"]) echo "selected";?> value="2">Instituto</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-4 col-md-4">
                                                <div class="form-group row">
                                                    <label class="text-truncate col-lg-4 col-form-label">Inicio</label>
                                                    <input type="date" required  class="form-control col-lg-8 col-sm-12" autofocus id="exampleFirstName" value="<?php echo $data["start"]?>" name="start">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4">
                                                <div class="form-group row">
                                                    <label for="inputMainName" class="text-truncate col-lg-4 col-form-label">Fin</label>
                                                    <input type="date" required class="form-control col-lg-8 col-sm-12" id="endExperience" value="<?php echo $data["end"]?>" name="end">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group row form-gr col-sm-12">
                                            <label for="inputMainLegend" class="col-sm-4 col-form-label">Status</label>
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

