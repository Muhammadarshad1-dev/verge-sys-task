<?php 
include('../controller/LoginUserController.php');
if (!isset($_SESSION['AdminLogin']) || $_SESSION['AdminLogin'] !== true) {
    header('Location: ../index.php');
    exit();
}
?>