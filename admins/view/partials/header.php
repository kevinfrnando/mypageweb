<!DOCTYPE html>
<html lang="en">

<head>
    <?php session_start(); ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Kevin Vergara - Dashboard</title>

  <link href="../assets/vendor/fontawesome-free/css/all.css" rel="stylesheet">

  <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">


  <link href="../assets/css/overhang.min.css" rel="stylesheet">

</head>
<?php

if( !isset($_SESSION["user"])){
    header("location:login.php");

}
?>



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

