<!-- Begin Page Content -->
<div class="container-fluid">


    <!-- Page Heading -->
    <div class="d-flex justify-content-between">
        <div class="col-sm-8">
            <h1 class="h3 mb-2 text-gray-800">Permisos</h1>
        </div>
        <div class="col-sm-4 d-flex justify-content-end">
            <a href="<?php echo _URL."authpermissions/insert"?>" class="btn btn-success btn-icon-split">
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
                        <th><span class="text-nowrap"> Crear </span></th>
                        <th><span class="text-nowrap"> Leer </span></th>
                        <th><span class="text-nowrap"> Actualizar </span></th>
                        <th><span class="text-nowrap"> Eliminar </span></th>
                        <th><span class="text-nowrap"> Creado Por </span></th>
                        <th><span class="text-nowrap"> Fecha Creación </span></th>
                        <th><span class="text-nowrap"> Modificado Por </span></th>
                        <th><span class="text-nowrap"> Ultima Modificación </span></th>
                        <th><span class="text-nowrap"> Acciones </span></th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th><span class="text-nowrap"> Code </span></th>
                        <th><span class="text-nowrap"> Description </span></th>
                        <th><span class="text-nowrap"> Version </span></th>
                        <th><span class="text-nowrap"> Crear </span></th>
                        <th><span class="text-nowrap"> Leer </span></th>
                        <th><span class="text-nowrap"> Actualizar </span></th>
                        <th><span class="text-nowrap"> Eliminar </span></th>
                        <th><span class="text-nowrap"> Creado Por </span></th>
                        <th><span class="text-nowrap"> Fecha Creación </span></th>
                        <th><span class="text-nowrap"> Modificado Por </span></th>
                        <th><span class="text-nowrap"> Ultima Modificación </span></th>
                        <th><span class="text-nowrap"> Acciones </span></th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php foreach ( $data["permissions"] as $permission) { ?>
                        <tr>
                            <td><span class="text-nowrap"> <?php echo $permission->code; ?></span></td>
                            <td><span class="text-nowrap"> <?php echo $permission->description; ?></span></td>
                            <td><span class="text-nowrap"> <?php echo $permission->version; ?></span></td>
                            <td class="text-center"><input <?php echo $permission->can_create == 1 ? "checked" : "" ; ?> onclick="javascript: return false;" type="checkbox"></td>
                            <td class="text-center"><input <?php echo $permission->can_read == 1 ? "checked" : "" ; ?> onclick="javascript: return false;" type="checkbox"></td>
                            <td class="text-center"><input <?php echo $permission->can_update == 1 ? "checked" : "" ; ?> onclick="javascript: return false;" type="checkbox"></td>
                            <td class="text-center"><input <?php echo $permission->can_delete == 1 ? "checked" : "" ; ?> onclick="javascript: return false;" type="checkbox"></td>
                            <td>
                                <span class="text-nowrap"> <?php
                                    foreach ( $data["users"] as $user ){
                                        if( $permission->created_by == $user->id){
                                            echo $user->full_name;
                                        }
                                    } ?>
                                </span>
                            </td>
                            <td><span class="text-nowrap"> <?php echo $permission->created_on; ?></span></td>
                            <td>
                                <span class="text-nowrap"> <?php
                                    foreach ( $data["users"] as $user ){
                                        if( $permission->updated_by == $user->id){
                                            echo $user->full_name;
                                        }
                                    } ?>
                                </span>
                            </td>
                            <td><span class="text-nowrap"> <?php echo $permission->updated_on; ?></span></td>

                            <td class="text-nowrap">
                                <a href="<?php echo _URL."authpermissions/insert/".helpers::encrypt($permission->id)?>" class="btn-success btn-sm">Editar</a>
                                <a href="#" class="btn-danger btn-sm" data-id="<?php echo helpers::encrypt($permission->id) ?>" data-toggle="modal" data-target="#deleteModal">Eliminar</a>
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
                        <a class="page-link" href="<?php echo _URL."authpermissions/".( $data["current"] - 1)?>" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <?php
                    for( $i = 0 ; $i < $data["totalTabs"]; $i ++){ ?>
                        <li class="page-item <?php echo ( $data["current"] == $i+1) ? "active" : "" ?>">
                            <a class="page-link" href="<?php echo _URL."authpermissions/".( $i + 1)?>"><?php echo $i + 1;?></a>
                        </li>
                    <?php }
                    ?>
                    <li class="page-item <?php echo ( $data["totalTabs"] == $data["current"] )  ? "disabled" : "" ?>">
                        <a class="page-link" href="<?php echo _URL."authpermissions/".( $data["current"] + 1)?>">Next</a>
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
                <a class="btn btn-danger" id="deleteAnchor" href="<?php echo _URL."authpermissions/delete/"?>">Eliminar</a>
            </div>
        </div>
    </div>
</div>

