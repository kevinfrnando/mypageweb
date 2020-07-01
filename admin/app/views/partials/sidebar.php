<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo _URL."dashboard"?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <!-- Nav Item - Dashboard -->

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProfile" aria-expanded="true" aria-controls="collapseProfile">
            <i class="fas fa-fw fa-address-card"></i>
            <span>Perfil</span>
        </a>
        <div id="collapseProfile" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Acciones:</h6>
                <a class="collapse-item" href="<?php echo _URL."mainprofile"?>">Perfil General</a>
                <a class="collapse-item" href="<?php echo _URL."users/insert"?>">Datos Personales</a>
                <a class="collapse-item" href="<?php echo _URL."users/insert"?>">Skills</a>
                <a class="collapse-item" href="<?php echo _URL."users/insert"?>">Redes Sociales</a>
            </div>
        </div>
    </li>
    <!-- Nav Item - Users Admin -->

    <!-- Nav Item - Users admin -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFormation" aria-expanded="true" aria-controls="collapseFormation">
            <i class="fas fa-fw fa-graduation-cap"></i>
            <span>Formación</span>
        </a>
        <div id="collapseFormation" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Acciones:</h6>
                <a class="collapse-item" href="<?php echo _URL."users/insert"?>">Experiencia Laboral</a>
                <a class="collapse-item" href="<?php echo _URL."users/"?>">Experiencia Academica</a>

            </div>
        </div>
    </li>
    <!-- Nav Item - Users Admin -->

    <!-- Nav Item - Users admin -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAbout" aria-expanded="true" aria-controls="collapseAbout">
            <i class="fas fa-fw fa-info-circle"></i>
            <span>Sobre mi</span>
        </a>
        <div id="collapseAbout" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Acciones:</h6>
                <a class="collapse-item" href="<?php echo _URL."users/insert"?>">Principal</a>
                <a class="collapse-item" href="<?php echo _URL."users/"?>">Proyectos </a>
                <a class="collapse-item" href="<?php echo _URL."users/"?>">Testimonial </a>

            </div>
        </div>
    </li>
    <!-- Nav Item - Users Admin -->


    <!-- Heading -->
        <div class="sidebar-heading">
            Herramientas de Administrador
        </div>

    <!-- Nav Item - Mantenimiento Menu -->

    <!-- Nav Item - Users admin -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true" aria-controls="collapseUsers">
            <i class="fas fa-fw fa-users"></i>
            <span>Usuarios</span>
        </a>
        <div id="collapseUsers" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Acciones:</h6>
                <a class="collapse-item" href="<?php echo _URL."users/insert"?>">Agregar Nuevo</a>
                <a class="collapse-item" href="<?php echo _URL."users/"?>">Listado</a>
                <a class="collapse-item" href="utilities-border.html">Permisos y Status</a>

            </div>
        </div>
    </li>
    <!-- Nav Item - Users Admin -->


    <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Componentes</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Mantenimiento:</h6>
                    <a class="collapse-item" href="#">Roles</a>
                    <a class="collapse-item" href="<?php echo _URL."authpermissions"?>">Permisos</a>
                    <a class="collapse-item" href="<?php echo _URL."tabs"?>">Tabs</a>
                    <a class="collapse-item" href="<?php echo _URL."login/logs"?>">Logs</a>
                </div>
            </div>
        </li>
    <!-- Nav Item - Pages Collapse Menu -->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->