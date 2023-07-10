<?php
include 'head.php';
include 'db_connect.php';

//search button on clicking
if (isset($_POST['search'])) {
$search_value= $_POST['search_value'];
$search_sql = "SELECT * FROM postbank_staff WHERE SR_NO = '$search_value'";
$Exec_search = mysqli_query($conn,$search_sql);
$num_data = mysqli_num_rows($Exec_search);
if ($Exec_search) {


    $raw_data = mysqli_fetch_assoc($Exec_search);
      $SR_NO = $raw_data['SR_NO'];
       $Firstname = $raw_data['Firstname'];
       $Surname = $raw_data['Surname'];
        $Middlename = $raw_data['Middlename'];
        $Branch = $raw_data['Branch'];
        $Region = $raw_data['Region'];
        //$start_date = $raw_data['start_date'];
      //  $end_date = $raw_data['end_date'];
        $job_status = $raw_data['job_status'];

        echo "
      <tbody>
      <tr>
        <td>$SR_NO</td>
        <td>$Firstname</td>
        <td>$Surname</td>
        <td>$Middlename</td>
        <td>$Branch</td>
        <td>$Region</td>

        <td>$job_status</td>

    <td><button type='button' class='btn btn-success editbtn' style='background-color:#0047AB;'>
     <i class='fa-solid fa-pen-to-square'></i> </button></td>



      </tr>

    </tbody>



          ";


  }


}


 ?>
