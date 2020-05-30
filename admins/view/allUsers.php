
<?php
include 'partials/header.php';

include '../controller/auth_user_controller.php';

$rows = auth_user_controller::getAllUser();
?>
<!-- Page Wrapper -->
    <!-- Content Wrapper -->
        <!-- Main Content -->

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
                        <th>Last Login</th>
                        <th>Last Ip</th>
                        <th>Fecha Creacion</th>
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
                        <?php foreach ( $rows as $row) { ?>
                            <tr>
                                <td hidden> <?php echo $row["id"]; ?></td>
                                <td> <?php echo $row["full_name"]; ?></td>
                                <td> <?php echo $row["user"]; ?></td>
                                <td> <?php echo $row["email"]; ?></td>
                                <td> <?php echo $row["created_on"]; ?></td>
                                <td> <?php echo $row["last_login"]; ?></td>
                                <td> <?php echo $row["last_ip"]; ?></td>
                                <td> <?php echo $row["permissions_id"]; ?></td>
                                <td> <a href="userRegister.php?id=<?php echo $row["id"]?>" class="btn-success btn-sm">Editar</a></td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->



<?php
include 'partials/footer.php';
?>