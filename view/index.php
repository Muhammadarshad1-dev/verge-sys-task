<?php 
include('../controller/LoginUserController.php');
$obj = new LoginUserController();
if (!isset($_SESSION['AdminLogin']) || $_SESSION['AdminLogin'] !== true) {
    header('Location: ../index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <?php include('../include/header.php'); ?>
<body>
<!-- Begin page -->
<div id="layout-wrapper">

<!-- Top Header -->
 <?php include('../include/top-header.php'); ?>
<!-- Close Top Header -->

<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

<div data-simplebar class="h-100">

<div class="navbar-brand-box">
    <a href="index.html" class="logo">
        <img src="../public/assets/images/logo-light.png" />
    </a>
</div>

<!--- Sidemenu -->
<?php include('../include/sidebar.php');?>
<!-- Sidebar -->

</div>
</div>
<!-- Left Sidebar End -->

<!-- Main content -->
<div class="main-content">

<div class="page-content">
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Dashboard</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Lunoz</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        
    </div>
    <!-- end row -->
</div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

<footer class="footer">
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            2020 © Lunoz.
        </div>
        <div class="col-sm-6">
            <div class="text-sm-right d-none d-sm-block">
                Design & Develop by Arshad Ali Babbar
            </div>
        </div>
    </div>
</div>
</footer>

</div>
<!-- end main content-->
</div>
<!-- END layout-wrapper -->
<!-- Overlay-->
<div class="menu-overlay"></div>


<!-- jQuery  -->
<script src="../public/assets/js/jquery.min.js"></script>
<script src="../public/assets/js/bootstrap.bundle.min.js"></script>
<script src="../public/assets/js/metismenu.min.js"></script>
<script src="../public/assets/js/waves.js"></script>
<script src="../public/assets/js/simplebar.min.js"></script>

<!-- Morris Js-->
<script src="../public/morris-js/morris.min.js"></script>
<!-- Raphael Js-->
<script src="../public/raphael/raphael.min.js"></script>

<!-- Morris Custom Js-->
<script src="../public/assets/pages/dashboard-demo.js"></script>

<!-- App js -->
<script src="../public/assets/js/theme.js"></script>

</body>

</html>

