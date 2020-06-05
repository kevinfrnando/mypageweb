
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tabs</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th hidden>Id</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Version</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th hidden>Id</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Version</th>
                        <th>Status</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php foreach ( $data["tabs"] as $tab) { ?>
                        <tr>
                            <td hidden> <?php echo $tab->id; ?></td>
                            <td> <?php echo $tab->name; ?></td>
                            <td> <?php echo $tab->code; ?></td>
                            <td> <?php echo $tab->version; ?></td>
                            <td> <?php echo $tab->status_id; ?></td>
                            <td>
                                <a href="<?php echo _URL."tabs/insert/".$user->id?>" class="btn-success btn-sm">Editar</a>
                                <a href="<?php echo _URL."tabs/delete/".$user->id?>" class="btn-success btn-sm">Eliminar</a>
                            </td>
                        </tr>
                    <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
