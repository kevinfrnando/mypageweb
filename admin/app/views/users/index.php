    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Usuarios</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th hidden>Id</th>
                            <th>Nombres</th>
                            <th>User</th>
                            <th>Email</th>
                            <th>Fecha Creacion</th>
                            <th>Last Login</th>
                            <th>Last Ip</th>
                            <th>Permisos</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th hidden>Id</th>
                            <th>Nombres</th>
                            <th>User</th>
                            <th>Email</th>
                            <th>Fecha Creacion</th>
                            <th>Last Login</th>
                            <th>Last Ip</th>
                            <th>Permisos</th>
                            <th>Acciones</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php foreach ( $data["users"] as $user) { ?>
                            <tr>
                                <td hidden> <?php echo $user->id; ?></td>
                                <td> <?php echo $user->full_name; ?></td>
                                <td> <?php echo $user->user; ?></td>
                                <td> <?php echo $user->email; ?></td>
                                <td> <?php echo $user->created_on; ?></td>
                                <td> <?php echo $user->last_login; ?></td>
                                <td> <?php echo $user->last_ip; ?></td>
                                <td> <?php echo $user->permissions_id; ?></td>
                                <td>
                                    <a href="<?php echo _URL."users/insert/".$user->id?>" class="btn-success btn-sm">Editar</a>
                                    <a href="<?php echo _URL."users/delete/".$user->id?>" class="btn-success btn-sm">Eliminar</a>
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
