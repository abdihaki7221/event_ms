<?php
include 'db_connect.php';

if (isset($_POST['book_venue'])) {
    $venue_name = $_POST['venue_name'];
    $available_from = $_POST['available_from'];
    $available_to = $_POST['available_to'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $price = $_POST['price'];
    $email = $_SESSION['username'];

    $insert_sql = "INSERT INTO venues (venue_name, available_from, available_to, start_time, end_time, price, email)
    VALUES ('$venue_name', '$available_from', '$available_to', '$start_time', '$end_time', '$price', '$email')";
    $result_insert = mysqli_query($conn, $insert_sql);

    if ($result_insert) {
        echo "<script>alert('Venue created successfully.')</script>";
    } else {
        echo "<script>alert('ERROR! Failed to create venue.')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
    <title>Create Venue</title>
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
        <form action="" method="post">
            <h4 class="register">Create Venue</h4>
            <!-- Venue name -->
            <div class="input-group mb-3" id="inputGroup-sizing-default">
                <input type="text" class="form-control" name="venue_name" placeholder="Enter Venue Name" aria-label="Username" aria-describedby="basic-addon1" required="required">
            </div>
            <!-- Available from date -->
            <div class="input-group mb-3 mt-3" id="inputGroup-sizing-default">
                <label for="Select Event date" class="regions">Available From Date</label>
                <input type="date" class="form-control" name="available_from" id="date" aria-label="Username" aria-describedby="basic-addon1" required="required">
            </div>
            <!-- Available to date -->
            <div class="input-group mb-3 mt-3" id="inputGroup-sizing-default">
                <label for="Select Event date" class="regions">Available To Date</label>
                <input type="date" class="form-control" name="available_to" id="date" aria-label="Username" aria-describedby="basic-addon1" required="required">
            </div>
            <!-- Start time -->
            <div class="input-group mb-3 mt-3" id="inputGroup-sizing-default">
                <label for="Select Event time" class="regions">Select Start Time</label>
                <input type="time" class="form-control" name="start_time" id="start_time" aria-label="Username" aria-describedby="basic-addon1" required="required">
            </div>
            <!-- End time -->
            <div class="input-group mb-3 mt-3" id="inputGroup-sizing-default">
                <label for="Select Event time" class="regions">Select End Time</label>
                <input type="time" class="form-control" name="end_time" id="end_time" aria-label="Username" aria-describedby="basic-addon1" required="required">
            </div>
            <!-- Price -->
            <div class="input-group mb-3 mt-3" id="inputGroup-sizing-default">
                <input type="text" class="form-control" name="price" placeholder="Enter Price" aria-label="Username" aria-describedby="basic-addon1" required="required">
            </div>
            <!-- Email of the logged-in session input -->
            <div class="input-group mb-3" id="inputGroup-sizing-default">
                <?php $username = $_SESSION['username']; ?>
                <input type="email" class="form-control" name="email" placeholder="Enter Email" value="<?php echo $username; ?>" aria-label="Username" aria-describedby="basic-addon1" required="required">
            </div>
            <!-- Button -->
            <div class="d-flex justify-content-center mt-1 mb-2">
                <button type="submit" name="book_venue" class="btn btn-primary">Create Venue</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
<script>
    $(document).ready(function () {
        $('.selectpicker').selectpicker();
    });
</script>
