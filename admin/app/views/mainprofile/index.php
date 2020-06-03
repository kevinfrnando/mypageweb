<div class="row">

    <div class="col-lg-11 mx-auto">

        <!-- Default Card Example -->
        <div class="card mb-10 mx-auto">
            <div class="card-header">
                <?php echo strtoupper($data->main_name)?>
            </div>
            <div class="card-body">
                <form>
                    <div class="row">
                        <div class="col">
                            <div class="form-group row form-gr col-sm-12">
                                <label for="inputMainName" class="col-sm-4 col-form-label">Nombre Principal</label>
                                <input type="text" class="form-control col-sm-8 " id="main_name" aria-describedby="mainNameHelp" placeholder="Nombre Principal">
                                <small id="mainNameHelp" class="form-text text-muted">Nombre que aparece en la página principal.</small>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group row form-gr col-sm-12">
                                <label for="inputMainLegend" class="col-sm-4 col-form-label">Legenda Principal</label>
                                <input type="text" class="form-control col-sm-8" id="main_legend" aria-describedby="emailHelp" placeholder="Legenda Principal">
                                <small id="mainLegendHelp" class="form-text text-muted">Legenda que aparece en la página principal.</small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group row form-gr col-sm-12">
                                <label class="col-sm-4 col-form-label">Titulo de Biografia</label>
                                <input type="text" class="form-control col-sm-8 " id="bio_title" aria-describedby="mainNameHelp" placeholder="Titulo Biografia">
                                <small id="bio_title" class="form-text text-muted">Titulo que aparece en la Biografia.</small>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group row form-gr col-sm-12">
                                <label class="col-sm-4 col-form-label">Legenda de Biografia</label>
                                <input type="text" class="form-control col-sm-8" id="bio_legend" aria-describedby="emailHelp" placeholder="Legenda Principal">
                                <small id="mainLegendHelp" class="form-text text-muted">Legenda que aparece en la Biografia.</small>
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