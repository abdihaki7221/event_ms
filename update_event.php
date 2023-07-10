<?php
include 'db_connect.php';

if (isset($_POST['event_id'])) {
    $event_id = $_POST['event_id'];
    $event_name = $_POST['event_name'];
    $description = $_POST['description'];
    $venue_name = $_POST['venue_name'];
    $event_date = $_POST['event_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $no_of_attendees = $_POST['no_of_attendees'];
    $charged_or_free = $_POST['charged_or_free'];
    $ticket_fee = $_POST['ticket_fee'];

    // Update event in the database
    $query = "UPDATE events SET
        event_name = '$event_name',
        description = '$description',
        venue_name = '$venue_name',
        event_date = '$event_date',
        start_time = '$start_time',
        end_time = '$end_time',
        no_of_attendees = '$no_of_attendees',
        charged_or_free = '$charged_or_free',
        ticket_fee = '$ticket_fee'
        WHERE event_id = '$event_id'";

    $result = mysqli_query($conn, $query);
    if (!$result) {
        die('Query execution failed: ' . mysqli_error($conn));
    }
}
?>
