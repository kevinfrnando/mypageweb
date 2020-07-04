<!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-flex justify-content-between">
            <div class="col-sm-8">
                <h1 class="h3 mb-2 text-gray-800">Usuarios</h1>
            </div>
            <div class="col-sm-4 d-flex justify-content-end">
                <a href="<?php echo _URL."users/insert"?>" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                  <i class="fas fa-plus"></i>
                </span>
                    <span class="text">Agregar Nuevo </span>
                </a>

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
                            <th hidden>Id</th>
                            <th> <span class="text-nowrap">Nombres </span></th>
                            <th> <span class="text-nowrap">User </span></th>
                            <th> <span class="text-nowrap">Email </span></th>
                            <th><span class="text-nowrap"> Fecha Creación </span></th>
                            <th><span class="text-nowrap"> Creado Por </span></th>
                            <th><span class="text-nowrap"> Ultima Modificación </span></th>
                            <th><span class="text-nowrap"> Modificado Por </span></th>
                            <th> <span class="text-nowrap">Status </span></th>
                            <th> <span class="text-nowrap">Last Login </span></th>
                            <th> <span class="text-nowrap">Last Ip </span></th>
                            <th> <span class="text-nowrap">Acciones </span></th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th> <span class="text-nowrap">Nombres </span></th>
                            <th> <span class="text-nowrap">User </span></th>
                            <th> <span class="text-nowrap">Email </span></th>
                            <th><span class="text-nowrap"> Fecha Creación </span></th>
                            <th><span class="text-nowrap"> Creado Por </span></th>
                            <th><span class="text-nowrap"> Ultima Modificación </span></th>
                            <th><span class="text-nowrap"> Modificado Por </span></th>
                            <th> <span class="text-nowrap">Status </span></th>
                            <th> <span class="text-nowrap">Last Login </span></th>
                            <th> <span class="text-nowrap">Last Ip </span></th>
                            <th> <span class="text-nowrap">Acciones </span></th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php foreach ( $data["users"] as $user) { ?>
                            <tr>
                                <td hidden> <?php echo $user->id; ?></td>
                                <td> <span class="text-nowrap"> <?php echo $user->full_name; ?> </span></td>
                                <td> <span class="text-nowrap"> <?php echo $user->user; ?> </span></td>
                                <td> <span class="text-nowrap"> <?php echo $user->email; ?> </span></td>
                                <td> <span class="text-nowrap"> <?php echo $user->created_on; ?> </span></td>
                                <td>
                                <span class="text-nowrap"> <?php
                                    foreach ( $data["usersArray"] as $user ){
                                        if( $user->created_by == $user->id){
                                            echo $user->full_name;
                                        }
                                    } ?>
                                </span>
                                </td>
                                <td><span class="text-nowrap"> <?php echo $user->updated_on; ?></span></td>
                                <td>
                                <span class="text-nowrap"> <?php
                                    foreach ( $data["usersArray"] as $user ){
                                        if( $user->updated_by == $user->id){
                                            echo $user->full_name;
                                        }
                                    } ?>
                                </span>
                                </td>
                                <td><span class="text-nowrap"> <?php
                                        foreach ($data["statusArray"] as $status){
                                            if( $user->status_id == $status->id){
                                                echo $status->description;
                                            }
                                        }
                                        ?></span>
                                </td>
                                <td> <span class="text-nowrap"> <?php echo $user->last_login; ?> </span></td>
                                <td> <span class="text-nowrap"> <?php echo $user->last_ip; ?> </span></td>
                                <td class="text-nowrap">
                                    <a href="<?php echo _URL."users/insert/".helpers::encrypt($user->id)?>" class="btn-success btn-sm">Editar</a>
                                    <a href="#" class="btn-danger btn-sm" data-id="<?php echo helpers::encrypt($user->id) ?>" data-toggle="modal" data-target="#deleteModal">Eliminar</a>
                                </td>

                            </tr>
                        <?php } ?>

                        </tbody>
                    </table>
                </div>
                <div>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item <?php echo ( $data["current"] == 1 )  ? "disabled" : "" ?>">
                                <a class="page-link" href="<?php echo _URL."users/".( $data["current"] - 1)?>" tabindex="-1" aria-disabled="true">Previous</a>
                            </li>
                            <?php
                            for( $i = 0 ; $i < $data["totalTabs"]; $i ++){ ?>
                                <li class="page-item <?php echo ( $data["current"] == $i+1) ? "active" : "" ?>">
                                    <a class="page-link" href="<?php echo _URL."tabs/".( $i + 1)?>"><?php echo $i + 1;?></a>
                                </li>
                            <?php }
                            ?>
                            <li class="page-item <?php echo ( $data["totalTabs"] == $data["current"] )  ? "disabled" : "" ?>">
                                <a class="page-link" href="<?php echo _URL."users/".( $data["current"] + 1)?>">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
