<div class="row">

    <div class="col-lg-11 mx-auto">

        <!-- Default Card Example -->
        <div class="card mb-10 mx-auto">
            <div class="card-header">
                About Me
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li class="media">
                        <div class="form-group row form-gr col-sm-12">
                            <textarea class="form-control col-sm-8" id="exampleFormControlTextarea1" readonly name="bio_profile" rows="3"></textarea>
                            <div class="form-control col-sm-2 h-100 d-inline-block" >
                                <img style="max-height: 100px;" src="https://ximagen.com/images/2018/12/23/imagenes-bonitas-para-compartir-en-esta-navidad.jpg" alt="..." class="img-thumbnail mr-3 rounded mx-auto d-block">
                            </div>
                            <div class="form-control col-sm-2 h-auto align-items-center">

                                <!--                                    --><?php //if( $data["permissions"]->can_update ) { ?>
                                <a style="text-align:center" class="btn-success btn-lg btn-block" href="<?php echo _URL."testimonials/insert/".helpers::encrypt($testimonial->id)?>" >Edit</a>
                                <!--                                    --><?php //} ?><!----><?php //if( $data["permissions"]->can_delete ) { ?>
                                <a href="#" style="text-align:center" class="btn-danger btn-lg btn-block -align-center" data-id="<?php echo helpers::encrypt($testimonial->id) ?>" data-toggle="modal" data-target="#deleteModal">Eliminar</a>
                                <!--                                    --><?php //} ?>
                            </div>

                            <!--                                <small id="mainLegendHelp" class="form-text text-muted">Biografia General.</small>-->
                        </div>
                    </li>
                    <li>
                        <div class="form-group row form-gr col-sm-12">
                            <a href="<?php echo _URL."about/insert"?>" class="btn btn-primary btn-block btn-sm">
                                <span class="text">Agregar Nuevo </span>
                            </a>
                        </div>
                    </li>
                </ul>



            </div>
        </div>


    </div>
</div>