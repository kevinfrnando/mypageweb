<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between">
        <div class="col-sm-3 d-flex">
            <?php
            if( isset( $data["id"])){ ?>
                <a href="<?php echo _URL."covers/insert"?>" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                          <i class="fa fa-plus"></i>
                        </span>
                    <span class="text">Nuevo </span>
                </a>
            <?php } ?>

        </div>
        <div class="col-sm-3 d-flex justify-content-end">
            <a href="<?php echo _URL."covers"?>" class="btn btn-success btn-icon-split">
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
                            <h1 class="h4 text-gray-900 mb-4"><?php echo $data["id"] ? "Editar" : "Registrar "?> Cover</h1>
                        </div>
                        <div class="card-body col-lg-12 mx-auto">
                            <form action="<?php echo _URL."covers/insert/".helpers::encrypt($data["id"]);?>" method="post">
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
                                            <label class="col-sm-4 col-form-label">Título</label>
                                            <input required type="text" class="form-control col-sm-8" name="title" value="<?php echo $data["title"]?>" placeholder="Video 001">
                                        </div>
                                        <div class="form-group row form-gr col-sm-12">
                                            <label class="col-sm-4 col-form-label">Descripción</label>
                                            <input required type="text" class="form-control col-sm-8" name="description" value="<?php echo $data["description"]?>" placeholder="Descripción">
                                        </div>
                                        <div class="form-group row form-gr col-sm-12">
                                            <label class="col-sm-4 col-form-label">YouTube Url</label>
                                            <input required type="text" class="form-control col-sm-8" name="url" value="<?php echo $data["url"]?>" placeholder="www.youtube.com/">
                                        </div>
                                        <div class="row col-lg-12 ">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group row">
                                                    <label class="text-truncate col-lg-4 col-form-label">Status</label>
                                                    <select class="form-control col-lg-8 col-sm-12" name="status_id">
                                                        <?php foreach ( $data["statusArray"] as $status) {?>
                                                            <option
                                                                value="<?php echo $status->id;?>"
                                                                <?php echo ($data["status_id"] == $status->id ? "selected": null) ?>>
                                                                <?php echo $status->description;?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group row">
                                                    <label class="text-truncate col-lg-4 col-form-label">Nav</label>
                                                    <select class="form-control col-lg-8 col-sm-12" name="nav_id">
                                                        <?php foreach ( $data["navsArray"] as $nav) {?>
                                                            <option
                                                                value="<?php echo $nav->id;?>"
                                                                <?php echo ($data["nav_id"] == $nav->id ? "selected": null) ?>>
                                                                <?php echo $nav->description;?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
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

