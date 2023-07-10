<?php
include 'db_connect.php';

if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];

    // Retrieve event details from the database
    $query = "SELECT * FROM events WHERE event_id = '$event_id'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die('Query execution failed: ' . mysqli_error($conn));
    }

    $event_details = mysqli_fetch_assoc($result);
    echo json_encode($event_details);
}
?>
