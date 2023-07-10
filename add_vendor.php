<?php
include 'db_connect.php';

$msg = "";
$msg_success="";

require 'PHPMailer.php';
require 'SMTP.php';
// Check if the form is submitted
if (isset($_POST['add_vendor'])) {
    $email = $_POST['email'];
    $event_name = $_POST['event_name'] ?? '';


      $username = $_SESSION['username'];




     $updateQuery = "UPDATE events SET vendor_email = '$email' WHERE planner_email = '$username' AND event_name = '$event_name'";
    $result_insert = mysqli_query($conn, $updateQuery);

    if ($result_insert) {

      $mail = new PHPMailer\PHPMailer\PHPMailer();
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->Port = 587;
      $mail->SMTPAuth = true;
      $mail->Username = 'kainosmartevents@gmail.com';
      $mail->Password = 'qrfnrkxldfzsqana';
      $mail->SMTPSecure = 'tls';

      $mail->setFrom('kainosmartevents@gmail.com', 'Paradise Planning');
      $mail->addAddress($email);

      $mail->Subject = 'Vendor Registration from Paradise Planning';
      $mail->Body = "You have added as a vendor for event $event_name by $username please register for the event at localhost/post_hr/user_registration.php";

      if ($mail->send()) {

            echo "<script>alert('vendor added successfully')</script>";
      } else {
          // Email sending failed
          echo "<script>alert('failed to send email')</script>";
      }

    } else {
        echo "<script>alert('Failed to add vendor')</script>";
    }
}
?>

<!-- Rest of the HTML code remains the same as provided before -->


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
    <title></title>
    <style>
      .form-control{
        font-size: 18px;
      }
      .register{
        font-size: 16px;
        font-weight: bold;
      }
      .regions{
        font-size: 16px;
      }
      .option_active{
        font-size: 18px;
      }
    </style>
  </head>
  <body class="body">
    <div class="row">
      <div class="col-3"></div>

      <div class="col-8 sm-4 shadow p-2 mt-5 ms-2 border" style="border-color:#0047AB;">
        <form action="" method="post">

          <h4 class="register">Add Vendor To Event</h4>

          <div class="text-center alert-danger ms-5 mb-2" style="border-radius:5px;">
              <?php echo $msg ?>
          </div>

          <div class="text-center alert-success ms-5 mb-2" style="border-radius:5px;">
              <?php echo $msg_success ?>
          </div>
          <!--planner name-->
          <div class="input-group mb-3" id="inputGroup-sizing-default">
            <input type="email" class="form-control" name="email" placeholder="Enter Vendor Email" aria-label="Username" aria-describedby="basic-addon1" required="required">
          </div>

          <label for="choose branch name" class="venue">Select Event name </label>
          <select name="event_name" id="framework" class="form-control selectpicker" data-live-search="true" onchange="updatePrice()">
        <option value="selected">Select event</option>
        <?php
        $username = $_SESSION['username'];
        $select_branches = "SELECT * FROM events where planner_email = '$username'";
        $exec_query = mysqli_query($conn, $select_branches);
        while ($fetch_data = mysqli_fetch_assoc($exec_query)) {
            $event_name = $fetch_data['event_name'];
            echo "<option value='$event_name'>$event_name</option>";
        }
        ?>
    </select>


          <!--button-->
          <div class="d-flex justify-content-center mt-1 mb-2">
            <button type="submit" name="add_vendor" class="btn btn-primary">Add Vendor</button>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>



<script>
$(document).ready(function(){
  $('.selectpicker').selectpicker();
});
</script>

<script>
$(document).ready(function(){
  $('.selectpicker').selectpicker();
});
</script>
