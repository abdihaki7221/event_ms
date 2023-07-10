<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $venue = $_POST['branch'];

    // Fetch the event_date, start_time, and end_time from the events table based on the selected venue
    $fetch_datetime_query = "SELECT event_date, start_time, end_time FROM booked_venues WHERE venue_name='$venue' LIMIT 1";
    $result_datetime = mysqli_query($conn, $fetch_datetime_query);
    $row_datetime = mysqli_fetch_assoc($result_datetime);
    $event_date = $row_datetime['event_date'] ?? '';
    $start_time = $row_datetime['start_time'] ?? '';
    $end_time = $row_datetime['end_time'] ?? '';

    // Prepare the response as JSON
    $response = array(
        'event_date' => $event_date,
        'start_time' => $start_time,
        'end_time' => $end_time
    );

    // Send the JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
