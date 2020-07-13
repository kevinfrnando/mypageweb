<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between">
        <div class="col-sm-3 d-flex">
            <?php
            if( isset( $data["id"])){ ?>
                <a href="<?php echo _URL."skills/insert"?>" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                          <i class="fa fa-plus"></i>
                        </span>
                    <span class="text">Nuevo </span>
                </a>
            <?php } ?>

        </div>
        <div class="col-sm-3 d-flex justify-content-end">
            <a href="<?php echo _URL."skills"?>" class="btn btn-success btn-icon-split">
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
                            <h1 class="h4 text-gray-900 mb-4"><?php echo $data["id"] ? "Editar" : "Registrar "?> Skill</h1>
                        </div>
                        <div class="card-body col-lg-10 mx-auto">
                            <form action="<?php echo _URL."skills/insert/".helpers::encrypt($data["id"]);?>" method="post">
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
                                            <label for="inputMainName" class="col-sm-4 col-form-label">Code</label>
                                            <input required type="text" class="form-control col-sm-8 " id="main_name" name="code" aria-describedby="codeHelp" value="<?php echo $data["code"]?>" placeholder="Código">
                                            <!--                                <small id="mainNameHelp" class="form-text text-muted">Nombre que aparece en la página principal.</small>-->
                                        </div>
                                        <div class="form-group row form-gr col-sm-12">
                                            <label for="inputMainLegend" class="col-sm-4 col-form-label">Descripción</label>
                                            <input required type="text" class="form-control col-sm-8" id="main_legend" name="description" aria-describedby="descriptionHelp" value="<?php echo $data["description"]?>" placeholder="Descripción">
                                            <!--                                <small id="mainLegendHelp" class="form-text text-muted">Legenda que aparece en la página principal.</small>-->
                                        </div>
                                        <div class="form-group row form-gr col-sm-12">
                                            <label for="inputMainLegend" class="col-sm-4 col-form-label">Type </label>
                                            <select class="form-control form-control-sm form-control col-sm-8" name="skills_type_id">
                                                <?php foreach ( $data["skillsTypeArray"] as $type) {?>
                                                    <option
                                                        value="<?php echo $type->id;?>"
                                                        <?php echo ($data["skills_type_id"] == $type->id ? "selected": null) ?>>
                                                        <?php echo $type->description;?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group row form-gr col-sm-12">
                                            <label for="inputMainLegend" class="col-sm-4 col-form-label">Percentage </label>
                                            <div class="slidecontainer form-control form-control-sm form-control col-sm-7 ">
                                                <input type="range" class="custom-range slider" min="1" max="100" name="percentage"  id="typeRange" oninput="typeRangeOutput.value = typeRange.value">
                                            </div>
                                            <output name="typeRangeOutput" id="ageOutputId" class="col-sm-1"></output>
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

