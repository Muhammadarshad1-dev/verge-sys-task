<?php
include('./controller/LoginUserController.php');
session_destroy(); //destroy the session
header("location:./index.php"); //to redirect back to "index.php" after logging out
exit();

?>