<?php //var_dump($_SESSION);?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-flex justify-content-between">
        <div class="col-sm-8">
            <h1 class="h3 mb-2 text-gray-800">Tabs</h1>
        </div>
        <div class="col-sm-4 d-flex justify-content-end">
            <a href="<?php echo _URL."tabs/insert"?>" class="btn btn-success btn-icon-split">
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
            <div class="table-responsive table-responsive-sm">
                <table class="table table-bordered table-striped table-hover table-sm" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th><span class="text-nowrap"> Code </span></th>
                        <th><span class="text-nowrap"> Description </span></th>
                        <th><span class="text-nowrap"> Version </span></th>
                        <th><span class="text-nowrap"> Fecha Creación </span></th>
                        <th><span class="text-nowrap"> Creado Por </span></th>
                        <th><span class="text-nowrap"> Ultima Modificación </span></th>
                        <th><span class="text-nowrap"> Modificado Por </span></th>
                        <th><span class="text-nowrap"> Status </span></th>
                        <th><span class="text-nowrap"> Acciones </span></th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Version</th>
                        <th>Fecha Creación</th>
                        <th>Creado Por</th>
                        <th>Ultima Modificación</th>
                        <th>Modificado Por</th>
                        <th>Status</th>
                        <th>Acciones</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php foreach ( $data["tabs"] as $tab) { ?>
                        <tr>
                            <td><span class="text-nowrap"> <?php echo $tab->code; ?></span></td>
                            <td><span class="text-nowrap"> <?php echo $tab->description; ?></span></td>
                            <td><span class="text-nowrap"> <?php echo $tab->version; ?></span></td>
                            <td><span class="text-nowrap"> <?php echo $tab->created_on; ?></span></td>
                            <td>
                                <span class="text-nowrap"> <?php
                                    foreach ( $data["usersArray"] as $user ){
                                        if( $tab->created_by == $user->id){
                                            echo $user->full_name;
                                        }
                                    } ?>
                                </span>
                            </td>
                            <td><span class="text-nowrap"> <?php echo $tab->updated_on; ?></span></td>
                            <td>
                                <span class="text-nowrap"> <?php
                                    foreach ( $data["usersArray"] as $user ){
                                        if( $tab->updated_by == $user->id){
                                            echo $user->full_name;
                                        }
                                    } ?>
                                </span>
                            </td>
                            <td><span class="text-nowrap"> <?php
                                foreach ($data["statusArray"] as $status){
                                    if( $tab->status_id == $status->id){
                                        echo $status->description;
                                    }
                                }
                                    ?></span>
                            </td>
                            <td class="text-nowrap">
                                <a href="<?php echo _URL."tabs/insert/".helpers::encrypt($tab->id)?>" class="btn-success btn-sm">Editar</a>
                                <a href="#" class="btn-danger btn-sm" data-id="<?php echo helpers::encrypt($tab->id) ?>" data-toggle="modal" data-target="#deleteModal">Eliminar</a>
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
                            <a class="page-link" href="<?php echo _URL."tabs/".( $data["current"] - 1)?>" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                        <?php
                        for( $i = 0 ; $i < $data["totalTabs"]; $i ++){ ?>
                            <li class="page-item <?php echo ( $data["current"] == $i+1) ? "active" : "" ?>">
                                <a class="page-link" href="<?php echo _URL."tabs/".( $i + 1)?>"><?php echo $i + 1;?></a>
                            </li>
                        <?php }
                        ?>
                        <li class="page-item <?php echo ( ($data["totalTabs"] == $data["current"] || $data["totalTabs"] == 0) )  ? "disabled" : "" ?>">
                            <a class="page-link" href="<?php echo _URL."tabs/".( $data["current"] + 1)?>">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

    </div>
</div>
<!-- /.container-fluid -->

<!-- Tabs Delete Modal -->
<div class="modal small fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Precaución</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Seguro deseas <strong>Eliminar</strong> este registro?.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger" id="deleteAnchor" href="<?php echo _URL."tabs/delete/"?>">Eliminar</a>
            </div>
        </div>
    </div>
</div>
