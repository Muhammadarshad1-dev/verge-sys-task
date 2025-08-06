<?php 
include('../controller/EmployeAdminController.php');
$obj = new EmployeAdminController();
?>
<link href="../public/plugins/dropify/dropify.min.css" rel="stylesheet" type="text/css" />
<?php 
if (isset($_POST['Eaid'])) {
  $EditAdmin=$obj->EditEmployeRecord($_POST);
  foreach ($EditAdmin as $key => $value) {
  ?>
<form id="Update_employe_form" class="Update_employe_form" method="post" enctype="multipart/form-data">
<div id="Sucess_msg"></div>

<input type="hidden" name="Eaid" value="<?php echo $value['id'];?>">

<div class="form-group">
<label for="name">Name</label>
<input type="text" class="form-control" name="edit_name" id="edit_name" 
value="<?php echo $value['employe_name'];?>">
</div>

<div class="form-group">
<label for="edit_email">Email</label>
<input type="email" class="form-control" name="edit_email" id="edit_email" aria-describedby="emailHelp" value="<?php echo $value['employe_email'];?>">
<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
</div>


 <div class="form-group">
        <label for="exampleInputPassword1">Department</label>
        <select name="department" id="department" class="form-control">
            <option value="">Choose Department</option>
            <option value="Web Development" <?php if($value['employe_dept'] == 'Web Development') echo 'selected'; ?>>Web Development</option>
            <option value="Design" <?php if($value['employe_dept'] == 'Design') echo 'selected'; ?>>Design</option>
            <option value="Marketing" <?php if($value['employe_dept'] == 'Marketing') echo 'selected'; ?>>Marketing</option>
            <option value="Sales" <?php if($value['employe_dept'] == 'Sales') echo 'selected'; ?>>Sales</option>
            <option value="Support" <?php if($value['employe_dept'] == 'Support') echo 'selected'; ?>>Support</option>
            <option value="HR" <?php if($value['employe_dept'] == 'HR') echo 'selected'; ?>>HR</option>        
        </select>
  </div>


<div class="form-group">
<label for="exampleInputPassword1">Upload file</label>
<input type="file" name="file" id="file" class="dropify"
       data-max-file-size="1M"
       accept="image/*"
       data-default-file="<?php echo $value['employe_file']; ?>" />

</div> 


<div class="modal-footer">
<button type="submit" name="submit" id="submit" class="btn btn-primary waves-effect waves-light">Update</button>
<button type="button" class="btn btn-success" data-dismiss="modal" aria-label="Close">Close
</button>
</div>
</form>
  <?php
  }
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="../public/assets/pages/fileuploads-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script src=" https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js">
    </script>
<!-- Datatables init -->

<script>
  $("#Update_employe_form").validate({
     // Define validation rules
    rules: {
        edit_name: {
            required: true,
            minlength: 3
        },
        edit_email: {
            required: true,
            email: true
        },
        department: {
            required: true
        }
    },
    messages: {
        employe_name: {
            required: "Please enter your name",
            minlength: "Your name must be at least 3 characters long"
        },
        employe_email: "Please enter a valid email address",
        department: "Please select a department"
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
                $('#Sucess_msg').html(data);
                window.location.reload();
            }
        });
        return false; // Prevent default form submission
    }
  });
</script>