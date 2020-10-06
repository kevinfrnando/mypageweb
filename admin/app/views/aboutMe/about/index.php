<div class="row">

    <div class="col-lg-11 mx-auto">

        <!-- Default Card Example -->
        <div class="card mb-10 mx-auto">
            <div class="card-header">
                About Me
            </div>
            <div class="card-body">

                <ul class="list-unstyled">
                    <?php foreach ( $data["about"] as  $about){ ?>
                    <li class="media">
                        <div class="form-group row form-gr col-sm-12">
                            <textarea class="form-control col-sm-8" id="aboutIndexTextArea" readonly name="bio_profile" rows="3"><?php echo  $about->description?></textarea>
                            <div class="form-control col-sm-2 h-100 d-inline-block" >
                                <?php foreach ( $data["fileArray"] as  $file){
                                    if(  $about->image_url == $file->id ){  ?>

                                        <img style="max-height: 100px;" src="http:\\localhost\media\admin\images\about_me\medium\<?php echo $file->name?>" alt="..." class="img-thumbnail mr-3 rounded mx-auto d-block">
                                    <?php    }
                                }
                                ?>
                            </div>
                            <div class="form-control col-sm-2 h-auto align-items-center">

                                <!--                                    --><?php //if( $data["permissions"]->can_update ) { ?>
                                <a style="text-align:center" class="btn-success btn-lg btn-block" href="<?php echo _URL."about/insert/".helpers::encrypt($about->id)?>" >Edit</a>
                                <!--                                    --><?php //} ?><!----><?php //if( $data["permissions"]->can_delete ) { ?>
                                <a href="#" style="text-align:center" class="btn-danger btn-lg btn-block -align-center" data-id="<?php echo helpers::encrypt($about->id) ?>" data-toggle="modal" data-target="#deleteModal">Eliminar</a>
                                <!--                                    --><?php //} ?>
                            </div>

                            <!--                                <small id="mainLegendHelp" class="form-text text-muted">Biografia General.</small>-->
                        </div>
                    </li>
                    <?php } ?>

                </ul>

                <div class="form-group row form-gr col-sm-12">
                    <a href="<?php echo _URL."about/insert"?>" class="btn btn-primary btn-block btn-sm">
                        <span class="text">Agregar Nuevo </span>
                    </a>
                </div>

            </div>
        </div>


    </div>
</div>

<!-- Tabs Delete Modal -->
<div class="modal small fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Precaución</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Seguro deseas <strong>Eliminar</strong> este registro?.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger" id="deleteAnchor" href="<?php echo _URL."about/delete/"?>">Eliminar</a>
            </div>
        </div>
    </div>
</div>