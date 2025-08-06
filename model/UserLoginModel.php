<?php
include '../controller/LoginUserController.php';
$obj = new LoginUserController();
?>

<?php
// Check if the session is already started
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
	$obj->UserLogin($_POST);
}
else{
	header('location:login.php');
}

?>