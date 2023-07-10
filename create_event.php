<?php

include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_name = $_POST['event_name'];
    $description = $_POST['description'];
    $venue = $_POST['branch'] ?? '';
    $event_date = $_POST['event_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $no_of_attendees = $_POST['no_of_attendees'];
    $charged_or_free = $_POST['charged_or_free'];
    $ticket_fee = 0;


    if ($charged_or_free == 'charged') {
        $ticket_fee = $_POST['ticket_fee'];
    }

    $imageNames = array();
   if (!empty($_FILES['event_images']['name'][0])) {
       $fileCount = count($_FILES['event_images']['name']);
       for ($i = 0; $i < $fileCount; $i++) {
           $fileName = $_FILES['event_images']['name'][$i];
           $fileTmpName = $_FILES['event_images']['tmp_name'][$i];
           $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
           $newFileName = uniqid() . '.' . $fileExtension;
           $uploadPath = 'uploads/' . $newFileName;

           if (move_uploaded_file($fileTmpName, $uploadPath)) {
               $imageNames[] = $newFileName;
           }
       }
   }

    // Fetch the venue email from the booked_venues table where planner_email matches the session username
    $username = $_SESSION['username'];
    $fetch_venue_email = "SELECT venue_email FROM booked_venues WHERE planner_email='$username' LIMIT 1";
    $result_venue_email = mysqli_query($conn, $fetch_venue_email);
    $row_venue_email = mysqli_fetch_assoc($result_venue_email);
    $venue_email = $row_venue_email['venue_email'] ?? '';


    // Insert data into the events table
    $insert_event_sql = "INSERT INTO events (event_name,planner_email, description, venue_name, event_date, start_time, end_time, no_of_attendees, charged_or_free, ticket_fee, venue_image)
     VALUES ('$event_name','$username', '$description', '$venue', '$event_date', '$start_time', '$end_time', '$no_of_attendees', '$charged_or_free', '$ticket_fee', '" . implode(",", $imageNames) . "')";
    $result_insert_event = mysqli_query($conn, $insert_event_sql);

    if ($result_insert_event) {
        echo "<script>alert('Event created successfully')</script>";
    } else {
        echo "<script>alert('Failed to create event')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
    <title>Create Event</title>
    <style>
        .form-control {
            font-size: 18px;
        }

        .register {
            font-size: 16px;
            font-weight: bold;
        }

        .regions {
            font-size: 16px;
        }

        .option_active {
            font-size: 18px;
        }
    </style>

</head>

<body class="body">
    <div class="row">
        <div class="col-3"></div>

        <div class="col-8 sm-4 shadow p-2 mt-5 ms-2 border" style="border-color:#0047AB;">
            <form action="" method="post" enctype="multipart/form-data">
                <h4 class="register">Create Event</h4>



                <div class="input-group mb-3" id="inputGroup-sizing-default">
                    <input type="text" class="form-control" name="event_name" placeholder="Event Name" required="required">
                </div>

                <div class="input-group mb-3" id="inputGroup-sizing-default">
                    <textarea class="form-control" name="description" placeholder="Description" required="required"></textarea>
                </div>

                <label for="choose branch name" class="venue">Select Event Venue</label>
                <select name="branch" id="framework" class="form-control selectpicker" data-live-search="true" onchange="updateDateTime()" required="required">
                    <option value="">Select venue</option>
                    <?php
                    $select_branches = "SELECT * FROM venues";
                    $exec_query = mysqli_query($conn, $select_branches);
                    while ($fetch_data = mysqli_fetch_assoc($exec_query)) {
                        $branch_name = $fetch_data['venue_name'];
                        echo "<option value='$branch_name'>$branch_name</option>";
                    }
                    ?>
                </select>

                <div class="input-group mb-3 mt-3" id="inputGroup-sizing-default">
    <label for="event_images" class="regions">Upload event logo</label>
    <input type="file" class="form-control" name="event_images[]" id="event_images" multiple>
</div>


                <div class="input-group mb-3 mt-3" id="inputGroup-sizing-default">
                    <label for="Select Event date" class="regions">Select Event Date</label>
                    <input type="date" class="form-control" name="event_date" id="date" required="required">
                </div>

                <div class="input-group mb-3 mt-3" id="inputGroup-sizing-default">
                    <label for="Select Event time" class="regions">Select Start Time</label>
                    <input type="time" class="form-control" name="start_time" id="start_time" required="required">
                </div>

                <div class="input-group mb-3 mt-3" id="inputGroup-sizing-default">
                    <label for="Select Event time" class="regions">Select End Time</label>
                    <input type="time" class="form-control" name="end_time" id="end_time" required="required">
                </div>

                <div class="input-group mb-3 mt-3" id="inputGroup-sizing-default">
                    <input type="number" class="form-control" name="no_of_attendees" placeholder="Number of Attendees" required="required">
                </div>

                <div class="input-group mb-3 mt-3" id="inputGroup-sizing-default">
                    <label for="charged_or_free" class="regions">Charged or Free</label>
                    <select name="charged_or_free" id="charged_or_free" class="form-control" onchange="showHideTicketFee()" required="required">
                        <option value="charged">Charged</option>
                        <option value="free">Free</option>
                    </select>
                </div>

                <div class="input-group mb-3 mt-3" id="ticket_fee_div" style="display: none;">
                    <input type="number" class="form-control" name="ticket_fee" id="ticket_fee" placeholder="Ticket Fee">
                </div>

                <br>

                <div class="d-flex justify-content-center mt-5 mb-2">
                    <button type="submit" name="create_event" class="btn btn-primary">Create Event</button>
                </div>
            </form>
        </div>
    </div>
</body>


</html>

<script>
function updateDateTime() {
var venue = document.getElementById("framework").value;
$.ajax({
  url: "get_datetime.php",
  type: "POST",
  data: {
      venue: venue
  },
  success: function(data) {
      var datetime = JSON.parse(data);
      document.getElementById("date").value = datetime.event_date;
      document.getElementById("start_time").value = datetime.start_time;
      document.getElementById("end_time").value = datetime.end_time;
  }
});
}

</script>

<script>
    // function updatePrice() {
    //     var venue = document.getElementById("framework").value;
    //     $.ajax({
    //         url: "get_price.php",
    //         type: "POST",
    //         data: {
    //             venue: venue
    //         },
    //         success: function(data) {
    //             document.getElementById("ticket_fee").value = data;
    //         }
    //     });
    // }

    function showHideTicketFee() {
        var chargedOrFree = document.getElementById("charged_or_free").value;
        if (chargedOrFree == "charged") {
            document.getElementById("ticket_fee_div").style.display = "block";
        } else {
            document.getElementById("ticket_fee_div").style.display = "none";
        }
    }
</script>
