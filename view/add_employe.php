<?php 
include('../controller/LoginUserController.php');
if (!isset($_SESSION['AdminLogin']) || $_SESSION['AdminLogin'] !== true) {
    header('Location: ../index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<!-- Header -->
<?php include('../include/header.php'); ?>
<!-- Close Header -->
<style>
    .error{
        color: red;
    }
</style>
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

<!--  Content here -->
<div class="main-content">
<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0 font-size-18">Add Employe</h4>
<div class="page-title-right">
<ol class="breadcrumb m-0">
    <li class="breadcrumb-item"><a href="javascript: void(0);">Employe</a></li>
    <li class="breadcrumb-item active">New Employe</li>
</ol>
</div>

</div>
</div>
</div>     
<!-- end page title -->

<div class="row">
<div class="col-xl-12">
<div class="card">
<div class="card-body">

<h4 class="card-title">Employe</h4>
  <form id="add_employe" class="add_employe" method="post">
     <div class="success_msg"></div>

     <div class="form-group">
        <label for="adminname">Name</label>
        <input type="text" class="form-control" name="employe_name" id="employe_name" placeholder="Name">
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Email</label>
        <input type="email" class="form-control" name="employe_email" id="employe_email" aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>


    <div class="form-group">
        <label for="exampleInputPassword1">Department</label>
        <select name="department" id="department" class="form-control">
            <option value="">Choose Department</option>
            <option value="Web Development">Web Development</option>
            <option value="Design">Design</option>
            <option value="Marketing">Marketing</option>
            <option value="Sales">Sales</option>
            <option value="Support">Support</option>
            <option value="HR">HR</option>        
        </select>
    </div>

 
    <div class="form-group">
    <label for="exampleInputPassword1">Upload file</label>
    <input type="file" name="file" id="file" class="dropify" data-max-file-size="1M"  accept="image/*"/>

    </div> 

    <div class="form-group mb-3">
       <button type="submit" name="submit" id="submit" class="btn btn-primary waves-effect waves-light">Add Employe</button>
    </div>
</form>

</div> <!-- end card-body-->
</div> <!-- end card-->
</div> <!-- end col -->
</div>
<!-- end row-->

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
Design & Develop by Myra
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="../public/assets/js/bootstrap.bundle.min.js"></script>
<script src="../public/assets/js/metismenu.min.js"></script>
<script src="../public/assets/js/waves.js"></script>
<script src="../public/assets/js/simplebar.min.js"></script>
<!-- File Upload link -->
<!--dropify-->
<script src="../public/plugins/dropify/dropify.min.js"></script>
<!-- Init js-->
<script src="../public/assets/pages/fileuploads-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script src=" https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js">
    </script>
</body>

</html>
<script>
// Form validation and submission
$(document).ready(function() {
$("#add_employe").validate({
   
    // Define validation rules
    rules: {
        employe_name: {
            required: true,
            minlength: 3
        },
        employe_email: {
            required: true,
            email: true
        },
        department: {
            required: true
        },
        file: {
            required: true,
            extension: "jpg|jpeg|png|gif"
        }
    },
    messages: {
        employe_name: {
            required: "Please enter your name",
            minlength: "Your name must be at least 3 characters long"
        },
        employe_email: "Please enter a valid email address",
        department: "Please select a department",
        file: "Please upload a valid image file (jpg, jpeg, png, gif)"
    },
    submitHandler: function(form) {
        $.ajax({
            type: 'post',
            url: '../model/MainEmployeModel.php',
            enctype: 'multipart/form-data',
            data: new FormData(form),
            processData: false,
            contentType: false,
            success: function(data) {
                console.log("Success",data);
                // Show success message
                    console.log("Server Response:", data); // Check raw response
                   $('.success_msg').html(data).fadeIn();

                    // Optional preview if your PHP returns the Dropbox URL
                    if (data.includes('https://www.dropbox.com')) {
                        const imgUrl = data.replace('?dl=0', '?raw=1'); // Direct image
                        $('.success_msg').append('<br><img src="' + imgUrl + '" width="100">');
                    }

                // Reset the form
                $('#add_employe')[0].reset();
            }
        });
        return false; // Prevent default form submission
    }
});
});
</script>