<?php
    include 'partials/header.php';


    if( isset($_SESSION["user"])){
        if( isset($_SESSION["user"])) {

        }

    }else{
        header("location:login.php");
    }
?>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

<?php
    include 'partials/sidebar.php';
?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <?php
                /**
                 *
                 * navSearch here
                 *
                 */
                ?>

                <ul class="navbar-nav ml-auto">
                    <?php
                    /**
                     *
                     * navSearchResults here
                     *
                     */
                    ?>


                    <?php
                    /**
                     *  NavBar
                     *  Notification section
                     *  - Messages
                     *  - Alerts
                     *  - User Info
                     */

                        include 'partials/navNotifications.php';
                        include 'partials/navUser.php';

                    ?>


                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">Blank Page</h1>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2019</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Deseas salir? :(</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Selecciona <strong>Salir</strong> si en realidad quieres salir.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="../controller/sessionDestroy.php">Salir</a>
            </div>
        </div>
    </div>
</div>

</body>


<?php
    include 'partials/footer.php';
?>