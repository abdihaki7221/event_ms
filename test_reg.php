<?php
include 'db_connect.php';
include 'head.php';
if (isset($_POST['add_staff'])) {
    $Fistname = $_POST['Fistname'];
    $Sirname = $_POST['Sirname'];
    $Middlename = $_POST['Middlename'];
    $Branch = $_POST['Branch'];
    $Region = $_POST['Region'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $job_status = $_POST['job_status'];


    $code = rand(9999999, 1111111);

  $insert_sql = "INSERT INTO postbank_staff(Fistname,Sirname,Middlename,Region,start_date,end_date,job_status,SR_NO)
  VALUES('$Fistname','$Sirname','$username','$Middlename','$Region','$start_date','$end_date','$job_status','SE/$code ')";
  $result_insert = mysqli_query($conn,$insert_sql);
  if ($result_insert) {
    echo "<script>alert ('staff added successfully ')</script>";
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
        <form action="" method="post" >

            <h5 class="register">Register Staff</h5>
                    <!--staff name-->
                 <div class="input-group mb-3" id="inputGroup-sizing-default">


                    <input type="text text-dark" class="form-control" name="Firstname"  placeholder="Enter Firstname" aria-label="Username" aria-describedby="basic-addon1" required ="required">

                 </div>





                 <!--sirname name-->
                 <div class="input-group mb-3 mt-3 " id="inputGroup-sizing-default">

                    <input type="text " class="form-control" name="sirname"  placeholder="Enter Sirname" aria-label="Username" aria-describedby="basic-addon1" required ="required">


                 </div>
                  <!--middle name-->
                 <div class="input-group mb-3 mt-3 " id="inputGroup-sizing-default">

                    <input type="email " class="form-control" name=Middlename  placeholder="Enter Middlename" id="username" aria-label="Username" aria-describedby="basic-addon1" >


                 </div>


                 <select name="select_box" class="form-select" id="select_box">
                       <option value="">Select Country</option>
                       <?php
                       $select_query = "SELECT * FROM test";
                       $result_select = mysqli_query($conn,$select_query);
                       while ($raw_data = mysqli_fetch_assoc($result_select)) {

                         $branch_name = $raw_data['branch_name'];

                            echo "<option value='$branch_name'>$branch_name</option>";

                          }
                       ?>
                   </select>








                   <div class="d-flex justify-content-center mt-1">
                       <input type="submit" name="add_staff" class="btn  text-white p-1 my-2"
                       value="Add Staff" style="background-color:#0047AB; color:#fff;">
                     </div>







    </form>
</div>
<select name="select_box" class="form-select" id="select_box">
      <option value="">Select Country</option>
      <?php
      $select_query = "SELECT * FROM test";
      $result_select = mysqli_query($conn,$select_query);
      while ($raw_data = mysqli_fetch_assoc($result_select)) {

        $branch_name = $raw_data['branch_name'];

           echo "<option value='$branch_name'>$branch_name</option>";

         }
      ?>
  </select>
    </div>

  <script src="main.js"></script>

    </script>


  </body>
</html>
