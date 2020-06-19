
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
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Id</th>
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
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Id</th>
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
                            <td> <?php echo $tab->id; ?></td>
                            <td> <?php echo $tab->code; ?></td>
                            <td> <?php echo $tab->description; ?></td>
                            <td> <?php echo $tab->version; ?></td>
                            <td> <?php echo $tab->created_on; ?></td>
                            <td> <?php echo $tab->created_by; ?></td>
                            <td> <?php echo $tab->updated_on; ?></td>
                            <td> <?php echo $tab->updated_by; ?></td>
                            <td> <?php
                                foreach ($data["statusObj"] as $status){
                                    if( $tab->status_id == $status->id){
                                        echo $status->description;
                                    }
                                }
                                ?>
                            </td>
                            <td>
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
                        <li class="page-item <?php echo ( $data["totalTabs"] == $data["current"] )  ? "disabled" : "" ?>">
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
            <form>
                <div class="modal-footer">

                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" id="deleteAnchor" href="<?php echo _URL."tabs/delete/"?>">Eliminar</a>
                </div>
            </form>
        </div>
    </div>
</div>
