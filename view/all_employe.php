<?php
include('../controller/EmployeAdminController.php');
$obj = new EmployeAdminController();
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


<!-- Start right Content here -->
<div class="main-content">

<div class="page-content">
<div class="container-fluid">

<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0 font-size-18">Employes Table</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="javascript: void(0);">Table</a></li>
<li class="breadcrumb-item active">Employes</li>
</ol>
</div>
</div>
</div>
</div>     
<!-- end page title -->


<!--Start Admin Edit Modal-->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title h4" id="myLargeModalLabel">Large modal</h5>
<button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<div id="employe_edit_modal"></div>
</div>
</div>
</div>
</div>
<!--End Admin Edit Modal-->




<!-- View Employee Modal -->
<div class="modal fade ViewEmployeModel" tabindex="-1" role="dialog" aria-labelledby="ViewEmployeModelLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header bg-white text-white">
        <h5 class="modal-title" id="ViewEmployeModelLabel">Employee Details</h5>
     <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
      </div>
      <div class="modal-body" id="employe_view_modal">
        <!-- Details will be injected here -->
      </div>
    </div>
  </div>
</div>
<!-- End View Employee Modal -->





<div class="row">
<div class="col-12">
<div class="card">
<div class="card-body">
<h4 class="card-title">Employes Record</h4>
<div class="success_msg"></div>
<table id="basic-datatable" class="table dt-responsive nowrap">
<thead>
<tr>
<th>S#no</th>
<th>Profile</th>
<th>Name</th>
<th>Email</th>
<th>Department</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>

<tbody>
<?php 
 $i=1;
 $data=$obj->DisplayAllEmploye();
 foreach ($data as $value) {
 ?>
 <tr>
<td><?php echo $i++;?></td>
<td><a href="<?php echo $value['employe_file'];?>" target="_blank" class="image-link" download>
  <img src="<?php echo $value['employe_file'];?>" class="image" height="50px" width="60px"></a>
</td>
<td><?php echo $value['employe_name'];?></td>
<td><?php echo $value['employe_email'];?></td>
<td><?php echo $value['employe_dept'];?></td>
<td>
 <select name="status" class="form-control status-dropdown" data-id="<?php echo $value['id']; ?>">
    <option value="1" <?php echo ($value['status'] == '1') ? 'selected' : ''; ?>>Active</option>
    <option value="0" <?php echo ($value['status'] == '0') ? 'selected' : ''; ?>>Probation</option>
 </select>
</td>
<td>

<button class="btn btn-success" id="EmployeEditBtn" data_e="<?php echo $value['id'];?>" data-toggle="modal" data-target=".bd-example-modal-lg">
<i class="bx bx-edit"></i></button>

<button class="btn btn-danger" id="Delete" data_d="<?php echo $value['id'];?>" >
<i class="bx bx-trash"></i></button>

<a href="../view/add_employe.php" class="btn btn-primary"><i class="bx bx-plus"></i></a>


<button class="btn btn-warning" 
    id="view"   
    data_view_id='<?php echo json_encode($value, JSON_HEX_APOS | JSON_HEX_QUOT); ?>' 
    data-toggle="modal" 
    data-target=".ViewEmployeModel" id="ViewEmployeModel">
    <i class="bx bx-show"></i>
</button>

</td>
</tr>
 <?php
 }
?>
</tbody>
</table>

</div> <!-- end card body-->
</div> <!-- end card -->
</div><!-- end col-->
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

<!-- third party js -->
<script src="../public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../public/plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="../public/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="../public/plugins/datatables/responsive.bootstrap4.min.js"></script>
<script src="../public/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="../public/plugins/datatables/buttons.bootstrap4.min.js"></script>
<script src="../public/plugins/datatables/buttons.html5.min.js"></script>
<script src="../public/plugins/datatables/buttons.flash.min.js"></script>
<script src="../public/plugins/datatables/buttons.print.min.js"></script>
<script src="../public/plugins/datatables/dataTables.keyTable.min.js"></script>
<script src="../public/plugins/datatables/dataTables.select.min.js"></script>
<script src="../public/plugins/datatables/pdfmake.min.js"></script>
<script src="../public/plugins/datatables/vfs_fonts.js"></script>
<script src="../public/plugins/dropify/dropify.min.js"></script>

<!-- Datatables init -->
<script src="../public/assets/pages/datatables-demo.js"></script>
<!-- App js -->
<script src="../public/assets/js/theme.js"></script>

<script src="../public/assets/pages/fileuploads-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script src=" https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js">
    </script>
<!-- Datatables init -->
</body>
</html>

<script>
    $(document).on('click','#EmployeEditBtn',function(e){
        e.preventDefault();
      var Eaid=$(this).attr('data_e');
        $.ajax({
            type:'post',
            url:'../model/EmployeEditModal.php',
            data:{Eaid:Eaid},
            success:function(data)
            {
              $('#employe_edit_modal').html(data);
            }
        });
    });
</script>


<script>
    $(document).on('click','#Delete',function(e){
        e.preventDefault();
        var Daid=$(this).attr('data_d');
         $.ajax({
            type:'post',
            url:'../model/MainEmployeModel.php',
            data:{Daid:Daid},
            success:function(data)
            {
              window.location.reload();
            }
        });
    }); 



    // View Employe Details
$(document).on('click', '#view', function(e) { 
    e.preventDefault();

    // Get JSON string and parse
    var rawData = $(this).attr('data_view_id');
    var data = JSON.parse(rawData);

    var html = `
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="row">

                    <!-- Profile Image -->
                    <div class="col-md-4 text-center border-end">
                        <img src="${data.employe_file}" 
                             alt="Profile" 
                             class="img-fluid rounded-circle shadow-sm mb-3"
                             style="width:150px; height:150px; object-fit:cover;">
                        <h5 class="mt-2 mb-0">${data.employe_name}</h5>
                        <span class="badge">${data.employe_dept}</span>
                    </div>

                    <!-- Employee Details -->
                    <div class="col-md-8">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>ID:</strong> ${data.id}
                            </li>
                            <li class="list-group-item">
                                <strong>Email:</strong> <a href="mailto:${data.employe_email}">${data.employe_email}</a>
                            </li>
                            <li class="list-group-item">
                                <strong>Department:</strong> ${data.employe_dept}
                            </li>
                            <li class="list-group-item">
                                <strong>Date Joined:</strong> ${data.date}
                            </li>
                            <li class="list-group-item">
                                <strong>Status:</strong> 
                                ${data.status == '1' 
                                    ? '<span class="badge bg-success">Active</span>' 
                                    : '<span class="badge bg-warning">Probation</span>'
                                }
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    `;

    $('#employe_view_modal').html(html);
});


// Update Employe Status on Change
$(document).on('change', '.status-dropdown', function() {
    var status = $(this).val();
    var employeId = $(this).data('id');

    $.ajax({
        type: 'POST',
        url: '../model/MainEmployeModel.php',
        data: { update_status: true, employeId: employeId, status: status },
        success: function(response) {
            $('.success_msg').html(response).fadeIn().delay(2000).fadeOut();
            // location.reload(); // Reload to reflect changes
        }
    });
});
</script>