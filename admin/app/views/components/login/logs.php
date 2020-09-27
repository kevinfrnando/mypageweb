
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-flex justify-content-between">
        <div class="col-sm-8">
            <h1 class="h3 mb-2 text-gray-800">Login Logs</h1>
        </div>
    </div>

    <br>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Host</th>
                        <th>App Name</th>
                        <th>Browser</th>
                        <th>Ip</th>
                        <th>Fecha</th>
                        <th>Tipo</th>
                        <th>Usuario</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Host</th>
                        <th>App Name</th>
                        <th>Browser</th>
                        <th>Ip</th>
                        <th>Fecha</th>
                        <th>Tipo</th>
                        <th>Usuario</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php foreach ( $data["logs"] as $tab) { ?>
                        <tr>
                            <td> <?php echo $tab->hostname; ?></td>
                            <td> <?php echo $tab->app_name; ?></td>
                            <td> <?php echo $tab->browser; ?></td>
                            <td> <?php echo $tab->ip; ?></td>
                            <td> <?php echo $tab->logged_on; ?></td>
                            <td> <?php echo $tab->type == 1 ? "Inicio Sesion" : "Cierre Sesion"; ?></td>
                            <td> <?php echo $tab->user_id; ?></td>
                        </tr>
                    <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
