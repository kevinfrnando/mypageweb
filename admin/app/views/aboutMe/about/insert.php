<div class="container-fluid">
    <div class="d-flex justify-content-between">
        <div class="col-sm-12 d-flex justify-content-end">
            <a href="<?php echo _URL."about";?> " class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fa fa-arrow-left"></i>
                    </span>
                <span class="text">Regresar </span>
            </a>

        </div>
    </div>
    <br>

    <div class="card-body p-0">
        <div class="row">
            <div class="col-lg-11 mx-auto">

                <!-- Default Card Example -->
                <div class="card mb-10 mx-auto">
                    <div class="card-header">
                        About Me
                    </div>
                    <div class="card-body">
                        <form action="<?php echo _URL."about/insert"; ;?>" id="form_about_me" method="post" enctype="multipart/form-data">
                            <?php if( isset($data["image_error"])){ ?>
                                <div class="row alert alert-warning alert-dismissible fade show" role="alert">
                                    <div>
                                        <strong>Error!</strong> No se puede cargar el archivo
                                        <p><strong>Razón: </strong> <?php echo $data["image_error"]["message"]?></p>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if( isset($data["error"])){ ?>
                                <div class="row alert alert-warning alert-dismissible fade show" role="alert">
                                    <div>
                                        <strong>Error!</strong> No se puede guardar <?php echo ($data["error"]["code"] == 23000 ? "por que ya existe un registro con este Código" : "Error Desconocido" )?>
                                        <p><strong>Código Sql: </strong> <?php echo $data["error"]["code"]?></p>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="row">
                                <input hidden type="text" name="id" value="<?php echo $data["id"]?>">
                                <div class="form-group row form-gr col-sm-8">
                                    <input type="text" id="RichText" name="description" value="<?php echo $data["description"]?>">
                                </div>

                                <div class="form-group row form-gr col-sm-4">
                                    <div class="col-sm-12">
                                        <input hidden type="text" id="image_about_id" value="<?php echo $data["image_url"]->id?>">
                                        <input required type="file" id="image_url" name="image_url" aria-describedby="urlImageHelp" placeholder="/image.png">
                                        <label for="image_url" class="btn-input btn btn-success btn-block ">Upload</label>
                                    </div>
                                    <div id="imagePreview">
<!--                                        <img class="image-preview-app" src="http:\\localhost\media\admin\images\about_me\medium\--><?php //echo $data["image_url"]->name?><!--" alt="..." class="img-thumbnail mr-3 rounded mx-auto d-block">-->
                                    </div>
                                </div>

                            </div>


                            <div class="row">
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Guardar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>

</div>



