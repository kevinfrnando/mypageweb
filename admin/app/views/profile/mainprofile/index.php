<div class="row">

    <div class="col-lg-11 mx-auto">

        <!-- Default Card Example -->
        <div class="card mb-10 mx-auto">
            <div class="card-header">
                <?php echo strtoupper($data->main_name)?>
            </div>
            <div class="card-body col-lg-12 mx-auto">
                <form action="<?php echo _URL."mainprofile/update";?>" method="post">
                    <input hidden type="text" name="id" value="<?php echo $data->id?>">
                    <div class="row col-lg-12">
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group row">
                                <label for="inputMainName" class="text-truncate col-lg-6 col-form-label">Nombre Principal</label>
                                <input type="text" class="form-control col-lg-6 col-sm-12 " id="main_name" name="main_name" aria-describedby="mainNameHelp" value="<?php echo $data->main_name?>" placeholder="Nombre Principal">
<!--                                <small id="mainNameHelp" class="form-text text-muted">Nombre que aparece en la página principal.</small>-->
                            </div>
                        </div>

                        <div class="col-lg-8 col-md-8">
                            <div class="form-group row">
                                <label for="inputMainLegend" class="text-truncate col-lg-4 col-form-label">Legenda Principal</label>
                                <input type="text" class="form-control col-lg-8 col-sm-12" id="main_legend" name="main_legend" value="<?php echo $data->main_legend?>" placeholder="Legenda Principal">
<!--                                <small id="mainLegendHelp" class="form-text text-muted">Legenda que aparece en la página principal.</small>-->
                            </div>
                        </div>
                    </div>

                    <div class="row col-lg-12">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group row">
                                <label class="text-truncate col-lg-4 col-form-label">Titulo de Bio.</label>
                                <input type="text" class="form-control col-lg-8 col-sm-12" id="bio_title" name="bio_title" value="<?php echo $data->bio_title?>" placeholder="Titulo Biografia">
<!--                                <small id="bio_title" class="form-text text-muted">Titulo que aparece en la Biografia.</small>-->
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group row">
                                <label class="text-truncate col-lg-4 col-form-label">Nacionalidad</label>
                                <input type="text" class="form-control col-lg-8 col-sm-12" id="nationality" name="nationality" value="<?php echo $data->nationality?>" placeholder="Nacionalidad">
<!--                                <small id="bio_title" class="form-text text-muted">Titulo que aparece en la Biografia.</small>-->
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group row">
                                <label class="text-truncate col-lg-4 col-form-label">Residencia</label>
                                <input type="text" class="form-control col-lg-8 col-sm-12" id="residency" name="residency" value="<?php echo $data->residency?>" placeholder="Residencia">
<!--                                <small id="bio_title" class="form-text text-muted">Titulo que aparece en la Biografia.</small>-->
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group row">
                                <label class="text-truncate col-lg-4 col-form-label">Profesión</label>
                                <input type="text" class="form-control col-lg-8 col-sm-12" id="profession" name="profession" value="<?php echo $data->profession?>" placeholder="Profesión">
<!--                                <small id="bio_title" class="form-text text-muted">Titulo que aparece en la Biografia.</small>-->
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group row">
                                <label class="text-truncate col-lg-4 col-form-label">Freelance</label>
                                <input type="text" class="form-control col-lg-8 col-sm-12" id="freelance" name="freelance" value="<?php echo $data->freelance ?>" placeholder="Freelance">
<!--                                <small id="bio_title" class="form-text text-muted">Titulo que aparece en la Biografia.</small>-->
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2">
                            <div class="form-group row">
                                <label class="text-truncate col-lg-6 col-form-label">Sangre</label>
                                <input type="text" class="form-control col-lg-6 col-sm-12" id="blood" name="blood" value="<?php echo $data->blood ?>" placeholder="Sangre">
<!--                                <small id="bio_title" class="form-text text-muted">Titulo que aparece en la Biografia.</small>-->
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group row">
                                <label class="text-truncate col-lg-4 col-form-label">Birthday</label>
                                <input type="date" class="form-control col-lg-8 col-sm-12" id="birthday" name="birthday" value="<?php echo $data->birthday ?>">
<!--                                <small id="bio_title" class="form-text text-muted">Titulo que aparece en la Biografia.</small>-->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group row form-gr col-sm-12">
                                <label class="text-truncate col-lg-3 col-form-label">Legenda de Biografia</label>
                                <input type="text" class="form-control col-lg-9 col-sm-12" id="bio_legend" name="bio_legend" aria-describedby="emailHelp" value="<?php echo $data->bio_legend?>" placeholder="Legenda Principal">
                                <!--                                <small id="mainLegendHelp" class="form-text text-muted">Legenda que aparece en la Biografia.</small>-->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group row form-gr col-sm-12">
                                <label class="col-sm-3 col-form-label">Biografia</label>
                                <textarea class="form-control col-sm-9" id="exampleFormControlTextarea1" name="bio_profile" rows="7"><?php echo $data->bio_profile?>
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