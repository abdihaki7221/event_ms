<?php
include 'db_connect.php';

// Check if the form is submitted
if (isset($_POST['book_venue'])) {
    $email = $_POST['email'];
    $venue = $_POST['branch'] ?? '';
    $event_date = $_POST['event_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    // Fetch available dates for the selected venue
    $fetch_dates = "SELECT email,available_from, available_to FROM venues WHERE venue_name='$venue'";
   $result_dates = mysqli_query($conn, $fetch_dates);
   $row_dates = mysqli_fetch_assoc($result_dates);
   $available_from = $row_dates['available_from'] ?? ''; // Initialize with fetched value or empty string if not found
   $available_to = $row_dates['available_to'] ?? '';
   $venue_email = $row_dates['email'] ?? '';
     // Initialize with fetched value or empty string if not found

    // Fetch price based on selected venue
    $fetch_price = "SELECT price FROM venues WHERE venue_name='$venue'";
    $result_price = mysqli_query($conn, $fetch_price);
    $row_price = mysqli_fetch_assoc($result_price);
    $price = $row_price['price'] ?? ''; // Initialize with fetched value or empty string if not found

    $code = rand(9999999, 1111111);

    $insert_sql = "INSERT INTO booked_venues (planner_email, venue_email,venue_name, event_date, start_time, end_time, price)
    VALUES ('$email', '$venue_email','$venue', '$event_date', '$start_time', '$end_time', '$price')";
    $result_insert = mysqli_query($conn, $insert_sql);

    if ($result_insert) {
        echo "<script>alert('Venue created successfully')</script>";
    } else {
        echo "<script>alert('Failed to create venue')</script>";
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

          <h4 class="register">Book event</h4>
          <!--planner name-->
          <div class="input-group mb-3" id="inputGroup-sizing-default">
            <input type="email" class="form-control" name="email" placeholder="Enter Email" value=<?php $username = $_SESSION['username']; echo $username; ?> aria-label="Username" aria-describedby="basic-addon1" required="required">
          </div>

          <label for="choose branch name" class="venue">Select Event venue </label>
          <select name="branch" id="framework" class="form-control selectpicker" data-live-search="true" onchange="updatePrice()">
      <option value="selected">Select venue</option>
      <?php
      $select_branches = "SELECT * FROM venues";
      $exec_query = mysqli_query($conn, $select_branches);
      while ($fetch_data = mysqli_fetch_assoc($exec_query)) {
          $branch_name = $fetch_data['venue_name'];
          echo "<option value='$branch_name'>$branch_name</option>";
      }
      ?>
  </select>


  <div class="input-group mb-3" id="inputGroup-sizing-default">
  <input type="text" class="form-control" name="price" id="price" placeholder="Enter price" aria-label="Username" aria-describedby="basic-addon1" required="required">
</div>



          <div class="input-group mb-3 mt-3" id="inputGroup-sizing-default">
            <label for="Select Event date" class="regions">Select Event Date </label>
            <input type="date" class="form-control" name="event_date" id="date" aria-label="Username" aria-describedby="basic-addon1" required="required">
          </div>

          <div class="input-group mb-3 mt-3" id="inputGroup-sizing-default">
            <label for="Select Event time" class="regions">Select Start Time </label>
            <input type="time" class="form-control" name="start_time" id="start_time" aria-label="Username" aria-describedby="basic-addon1" required="required">
          </div>

          <div class="input-group mb-3 mt-3" id="inputGroup-sizing-default">
            <label for="Select Event time" class="regions">Select End Time </label>
            <input type="time" class="form-control" name="end_time" id="end_time" aria-label="Username" aria-describedby="basic-addon1" required="required">
          </div>

          <div class="input-group mb-3 mt-3" id="inputGroup-sizing-default">
            <label for="available_dates" id="available_dates_label" class="regions">Available Dates: <?php
      $venue = $_POST['branch'] ?? '';
      $fetch_dates = "SELECT available_from, available_to FROM venues WHERE venue_name='$venue'";
      $result_dates = mysqli_query($conn, $fetch_dates);
      $row_dates = mysqli_fetch_assoc($result_dates);
      $available_from = $row_dates['available_from'] ?? ''; // Initialize with fetched value or empty string if not found
      $available_to = $row_dates['available_to'] ?? '';
      echo "From $available_from - To $available_to"; ?></label>

          </div>

          <!--button-->
          <div class="d-flex justify-content-center mt-1 mb-2">
            <button type="submit" name="book_venue" class="btn btn-primary">Book venue</button>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>

<script>
function updatePrice() {
    var venue = document.getElementById("framework").value;
    $.ajax({
        url: "get_price.php",
        type: "POST",
        data: { venue: venue },
        success: function(response) {
            document.getElementById("price").value = response;

            // Fetch available dates for the selected venue
            $.ajax({
                url: "get_available_dates.php",
                type: "POST",
                data: { venue: venue },
                success: function(response) {
                    document.getElementById("available_dates_label").innerHTML = "Available Dates: " + response;
                }
            });
        }
    });
}

</script>


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
