<?php
include 'db_connect.php';

if (isset($_GET['delete_id'])) {
  $delete_id = $_GET['delete_id'];

$sql = "DELETE  FROM staff WHERE staff_id= '$delete_id'";
$sql_result=mysqli_query($conn,$sql);
if ($sql_result) {
  header('location:admin_dashboard.php?manage_users');
}else {
  echo "error occurred";
}

}

 ?>
