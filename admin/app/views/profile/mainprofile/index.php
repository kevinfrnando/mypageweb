<div class="row">

    <div class="col-lg-11 mx-auto">

        <!-- Default Card Example -->
        <div class="card mb-10 mx-auto">
            <div class="card-header">
                <?php echo strtoupper($data->main_name)?>
            </div>
            <div class="card-body">
                <form action="<?php echo _URL."mainprofile/update";?>" method="post">
                    <input hidden type="text" name="id" value="<?php echo $data->id?>">
                    <div class="row">
                        <div class="col">
                            <div class="form-group row form-gr col-sm-12">
                                <label for="inputMainName" class="col-sm-4 col-form-label">Nombre Principal</label>
                                <input type="text" class="form-control col-sm-8 " id="main_name" name="main_name" aria-describedby="mainNameHelp" value="<?php echo $data->main_name?>" placeholder="Nombre Principal">
<!--                                <small id="mainNameHelp" class="form-text text-muted">Nombre que aparece en la página principal.</small>-->
                            </div>
                            <div class="form-group row form-gr col-sm-12">
                                <label for="inputMainLegend" class="col-sm-4 col-form-label">Legenda Principal</label>
                                <input type="text" class="form-control col-sm-8" id="main_legend" name="main_legend" aria-describedby="emailHelp" value="<?php echo $data->main_legend?>" placeholder="Legenda Principal">
<!--                                <small id="mainLegendHelp" class="form-text text-muted">Legenda que aparece en la página principal.</small>-->
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group row form-gr col-sm-12">
                                <label class="col-sm-4 col-form-label">Titulo de Biografia</label>
                                <input type="text" class="form-control col-sm-8 " id="bio_title" name="bio_title" aria-describedby="mainNameHelp" value="<?php echo $data->bio_title?>" placeholder="Titulo Biografia">
<!--                                <small id="bio_title" class="form-text text-muted">Titulo que aparece en la Biografia.</small>-->
                            </div>
                            <div class="form-group row form-gr col-sm-12">
                                <label class="col-sm-4 col-form-label">Legenda de Biografia</label>
                                <input type="text" class="form-control col-sm-8" id="bio_legend" name="bio_legend" aria-describedby="emailHelp" value="<?php echo $data->bio_legend?>" placeholder="Legenda Principal">
<!--                                <small id="mainLegendHelp" class="form-text text-muted">Legenda que aparece en la Biografia.</small>-->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group row form-gr col-sm-12">
                                <label class="col-sm-4 col-form-label">Biografia</label>
                                <textarea class="form-control col-sm-8" id="exampleFormControlTextarea1" name="bio_profile" rows="7"><?php echo $data->bio_profile?>
                                </textarea>
<!--                                <small id="mainLegendHelp" class="form-text text-muted">Biografia General.</small>-->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-primary btn-user btn-block">

                            Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>


    </div>
</div>