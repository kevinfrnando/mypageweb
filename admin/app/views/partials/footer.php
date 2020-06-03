    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; KevinVergara.com <?php  echo date("Y") ?></span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->


    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#wrapper">
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
                    <a class="btn btn-primary" href="<?php echo _URL."login/logOut"?>">Salir</a>
                </div>
            </div>
        </div>
    </div>


</body>

<!-- Bootstrap core JavaScript-->
<script src="<?php echo _ASSETS?>vendor/jquery/jquery.min.js"></script>
<script src="<?php echo _ASSETS?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo _ASSETS?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo _ASSETS?>js/sb-admin-2.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>


<!-- Page level plugins -->
<script src="<?php echo _ASSETS?>vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?php echo _ASSETS?>js/demo/chart-area-demo.js"></script>
<script src="<?php echo _ASSETS?>js/demo/chart-pie-demo.js"></script>



<!-- AJAX JS -->
<script src="<?php echo _ASSETS?>js/overhang.min.js"></script>
<!--<script src="--><?php //echo _ASSETS?><!--js/functions.js"></script>-->
<script src="<?php echo _ASSETS?>js/app.js"></script>
<!--<script src="--><?php //echo _ASSETS?><!--js/jquery.validate.min.js"></script>-->


</html>
