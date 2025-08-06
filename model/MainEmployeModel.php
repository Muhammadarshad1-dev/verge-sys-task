<?php 
include('../controller/EmployeAdminController.php');
$obj = new EmployeAdminController();
?>

<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['employe_name']))
{
  $obj->AddAdmin($_POST);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_name']))
{
  $obj->UpdateEmployeRecord($_POST);
}
 

if (isset($_POST['Daid'])) {
   $obj->EmployeDelete($_POST);
}



// Update Employe Status 
if (isset($_POST['employeId']) && isset($_POST['status'])) {
    $obj->UpdateEmployeStatus($_POST);
}


















































?>
