<div class="row">

    <div class="col-lg-11 mx-auto">

        <!-- Default Card Example -->
        <div class="card mb-10 mx-auto">
            <div class="card-header">
                About Me
            </div>
            <div class="card-body">
                <form action="<?php echo _URL."aboutme/update";?>" method="post">
                    <div class="row">
                        <div class="form-group row form-gr col-sm-8">
                            <input type="text" id="RichText" name="description">
                        </div>
                        <div class="form-group row form-gr col-sm-4">
                            <div class="col-sm-12">
                                <input required type="file" id="image_url" name="image_url" aria-describedby="urlImageHelp" value="<?php echo $data["image_url"]?>" placeholder="/image.png">
                                <label for="image_url" class="btn-input btn btn-success btn-block ">Upload</label>
                            </div>
                            <div id="imagePreview"></div>
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
