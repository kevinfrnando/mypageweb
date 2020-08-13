<div class="row">

    <div class="col-lg-11 mx-auto">

        <!-- Default Card Example -->
        <div class="card mb-10 mx-auto">
            <div class="card-header">
                About Me
            </div>
            <div class="card-body">
                <form action="<?php echo _URL."mainprofile/update";?>" method="post">
                    <div class="row">
                        <div class="form-group row form-gr col-sm-8">
                            <input type="text" id="RichText">
                        </div>
                        <div class="form-group row form-gr col-sm-4">
                            <input required type="file" class="form-control col-sm-12" id="image_url" name="image_url" aria-describedby="urlImageHelp" value="<?php echo $data["image_url"]?>" placeholder="/image.png">

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
