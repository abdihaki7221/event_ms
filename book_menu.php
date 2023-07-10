<?php
include 'db_connect.php';
require 'PHPMailer.php';
require 'SMTP.php';

if (isset($_POST['eventId']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['menuSelect'])) {
  $eventId = $_POST['eventId'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $menuSelect = $_POST['menuSelect'];

  // Check if the event is already booked by the attendee
  $check_booking = "SELECT * FROM booked_events WHERE event_id = '$eventId' AND attendee_email = '$email'";
  $result_check_booking = mysqli_query($conn, $check_booking);
  if (mysqli_num_rows($result_check_booking) > 0) {
    echo "Error: Already booked for this event!";
    exit;
  }

  // Fetch planner email from events table
  $select_planner_email = "SELECT * FROM events WHERE event_id = '$eventId'";
  $result_planner_email = mysqli_query($conn, $select_planner_email);
  $planner_data = mysqli_fetch_assoc($result_planner_email);
  $plannerEmail = $planner_data['planner_email'];
  $vendorEmail = $planner_data['vendor_email'];
    $event_name = $planner_data['event_name'];




  // Insert the menu data into the database
  $insert_menu = "INSERT INTO booked_events (event_id, menu, vendor_email, planner_email, attendee_name, attendee_email) VALUES ('$eventId', '$menuSelect', '$vendorEmail', '$plannerEmail', '$name', '$email')";
  if (mysqli_query($conn, $insert_menu)) {

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = 'kainosmartevents@gmail.com';
    $mail->Password = 'qrfnrkxldfzsqana';
    $mail->SMTPSecure = 'tls';

    $mail->setFrom('kainosmartevents@gmail.com', 'Paradise Planning');
    $mail->addAddress($plannerEmail);

    $mail->Subject = 'Event booking from paradise Bookings';
    $mail->Body = "$name has booked $event_name with menu as $menuSelect";

    if ($mail->send()) {
          echo "Event Booked successfully!";

    } else {
        // Email sending failed
        echo "message not sent !";
    }

  } else {
    echo "Error creating menu: " . mysqli_error($conn);
  }
} else {
  echo "Invalid request!";
}
?>
