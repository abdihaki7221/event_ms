<?php
if (isset($_POST['add_staff'])) {
  $staff_name = $_POST['staff_name'];
  $branch_name = $_POST['branch_name'];
  $username = $_POST['username'];
  $pass_key = md5($_POST['pass_key']);



  $sql = "SELECT * FROM staff where username = '$username'";
  $result = mysqli_query($conn,$sql);
  $num_rows = mysqli_num_rows($result);
  if ($num_rows > 0) {
  echo "<script>alert ('ERROR!! Staff already exists')</script>";
}else {
  $insert_sql = "INSERT INTO staff(staff_name,branch_name,username,pass_key,code) VALUES('$staff_name','$branch_name','$username','$pass_key','0')";
  $result_insert = mysqli_query($conn,$insert_sql);
  if ($result_insert) {
    echo "<script>alert ('staff added successfully ')</script>";
  }
}
}


 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body class="body">
    <div class="row">
      <div class="col-3">


      </div>

      <div class="col-8  sm-4 shadow p-2 mt-4 ms-2 border" style="border-color:#0047AB">
        <form action="" method="post" enctype="multipart/form-data">

            <h5>Add HR staff</h5>
                    <!--staff name-->
                 <div class="input-group mb-3" id="inputGroup-sizing-default">


                    <input type="text text-dark" class="form-control" name="staff_name"  placeholder="Enter Staff name" aria-label="Username" aria-describedby="basic-addon1" required ="required">

                 </div>





                 <!--Branch name-->
                 <div class="input-group mb-3 mt-3 " id="inputGroup-sizing-default">

                    <input type="text " class="form-control" name="branch_name"  placeholder="Enter Branch name" aria-label="Username" aria-describedby="basic-addon1" required ="required">


                 </div>

                 <div class="input-group mb-3 mt-3 " id="inputGroup-sizing-default">

                    <input type="email " class="form-control" name="username"  placeholder="Enter staff email" id="username" aria-label="Username" aria-describedby="basic-addon1" required ="required">


                 </div>

                 <!--Staff pass key-->

                 <div class="input-group mb-2 mt-3" id="inputGroup-sizing-default">

                    <input type="password" class="form-control" name="pass_key"  placeholder="Create pass key" aria-label="Username" aria-describedby="basic-addon1" required ="required" >

                 </div>








                   <div class="d-flex justify-content-center mt-1">
                       <input type="submit" name="add_staff" class="btn  text-white p-1 my-2"
                       value="Add Staff" style="background-color:#0047AB; color:#fff;">
                     </div>


      </div>

    </div>


    </form>

    </div>
  </body>
</html>
