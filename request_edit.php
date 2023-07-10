<?php
include 'head.php';
include 'db_connect.php';
include 'functions/common_functions.php';
$parcel_no = $_GET['update_id'];

  $msg="";
  $sql = "SELECT * FROM parcel_details WHERE parcel_no= '$parcel_no'";
  $sql_result = mysqli_query($conn,$sql);
  $rows = mysqli_fetch_assoc($sql_result);
  $description = $rows['description'];
  $parcel_no = $rows['parcel_no'];
  $order_status = $rows['Order_status'];
  $payment_status = $rows['payment_status'];
  $receiver_name = $rows['receiver_name'];
  $payment_code = $rows['payment_code'];
  $amount = $rows['amount'];
  $sender_phone = $rows['sender_phone'];

  if (isset($_POST['update'])) {
    $payment_code = $_POST['payment_code'];
    $receiver_name = $_POST['receiver_name'];
    $description = $_POST['description'];
    $payment_status = $_POST['payment_status'];
    $delivery_status = $_POST['select_item'];
    $amount = $_POST['amount'];
    $sender_phone = $_POST['sender_phone'];

    $sql_update = "UPDATE parcel_details set receiver_name = '$receiver_name',description = '$description',
    payment_status = '$payment_status',payment_code = '$payment_code',amount = '$amount',Order_status = '$delivery_status'
    WHERE parcel_no = '$parcel_no'
    ";

    $update_result = mysqli_query($conn,$sql_update);
    if ($update_result) {
      $baseurl = "https://api.mobitechtechnologies.com/sms/sendsms";
      $ch = curl_init($baseurl);
      $data = array(
          "mobile" => $sender_phone,
          "response_type" => "json",
          "sender_name" => "23107",
          "service_id" => 0,
          "message" => "Your delivery request has been accepted. Our driver is on the way",

      );
      $payload = json_encode($data);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'h_api_key:e7e486b6a627a27fa938c8c8cbb12e47ca15bfdf915a63df28483980a5dc117f'));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $result = json_encode(curl_exec($ch));
      if ($result) {
        $msg="Records updated successfully";
      }else {
        echo "failed";
      }
        curl_close($ch);
  }
  }



?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="style.css">
       <link rel="stylesheet" href="css\bootstrap.min.css">

       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.1/css/fontawesome.min.css" integrity="sha384-zIaWifL2YFF1qaDiAo0JFgsmasocJ/rqu7LKYH8CoBEXqGbb9eO+Xi3s6fQhgFWM" crossorigin="anonymous">

       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0-beta1/css/bootstrap.min.css" />


       <!-- Place your kit's code here -->
       <script src="https://kit.fontawesome.com/26250a0a21.js" crossorigin="anonymous"></script>
  </head>
  <body class="body">
    <div class="container">
      <div class="row mt-5">
        <div class="col-2">

        </div>
        <div class="col-8">
          <div class="card" style="">
            <div class="card-body">
              <h5 class="card-title">Update delivery status</h5>
              <?php
              if ($msg) {
                echo "<div class='alert alert-success' role='alert'>
                  $msg
                </div>";
              }

               ?>
              <form method="post">


                        <!--Receipient name-->
                     <div class="input-group mb-3" id="inputGroup-sizing-default">


                        <input type="text text-dark" class="form-control" name="receiver_name"  value="<?php echo "$receiver_name";?>" aria-label="Username" aria-describedby="basic-addon1" required ="required">

                     </div>
                     <!--parcel details-->
                  <div class="input-group mb-3" id="inputGroup-sizing-default">


                     <input type="text text-dark" class="form-control" name="description"  value="<?php echo "$description";?>"  aria-label="Username" aria-describedby="basic-addon1" required ="required">

                  </div>
                  <div class="input-group mb-3" id="inputGroup-sizing-default">


                     <input type="text text-dark" class="form-control" name="sender_phone"  value="<?php echo "$sender_phone";?>"  aria-label="Username" aria-describedby="basic-addon1" required ="required">

                  </div>




                     <!--mpesa code-->
                     <div class="input-group mb-3 mt-3 " id="inputGroup-sizing-default">

                        <input type="text " class="form-control" name="payment_code"  value="<?php echo "$payment_code";?>"  aria-describedby="basic-addon1" required ="required">


                     </div>
                     <!--amount-->
                     <div class="input-group mb-3 mt-3 " id="inputGroup-sizing-default">

                        <input type="text " class="form-control" name="amount"  value="<?php echo "$amount";?>"  aria-describedby="basic-addon1" required ="required">


                     </div>
                     <!--payment status-->
                     <div class="input-group mb-3 mt-3" id="inputGroup-sizing-default">
                      <select class="form-select" name="payment_status" aria-label="select example" required ="required">
                        <option value="">Select Payment Status</option>
                        <option value="Paid">Paid</option>
                        <option value="Not Paid">Not paid</option>


                      </select>

                    </div>

                     <!--delivery status-->
                     <div class="input-group mb-3 mt-3" id="inputGroup-sizing-default">
                      <select class="form-select" name="select_item" aria-label="select example" required ="required">
                        <option value="">select delivery status</option>
                        <option value="Accepted">Accepted</option>
                        <option value="At Vendor">At Vendor</option>
                        <option value="In Transit">In Transit</option>
                        <option value="Delivered">Delivered</option>

                      </select>

                    </div>






                    <div class="mt-2">
                      <a href="admin_loriany_dashboard.php?list_requests" class="btn" style="background-color: #F88379; color: #fff;">Close</a>
                      <a href=""><input type="submit" name ="update" class="btn btn-primary" value = "Update"></a>
                    </div>

                </form>

            </div>
          </div>
        </div>
        <div class="col-2">

        </div>
      </div>
    </div>


<script type="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>

  </body>
</html>
