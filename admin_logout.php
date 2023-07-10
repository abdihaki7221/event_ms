<?php
include 'db_connect.php';
unset($_SESSION['USER_ID']);
unset($_SESSION['USER_NAME']);
header("location: admin_login.php");

 ?>
