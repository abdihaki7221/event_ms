<?php
include 'db_connect.php';

if (isset($_POST['venue'])) {
    $venue = $_POST['venue'];
    $fetch_dates = "SELECT available_from, available_to FROM venues WHERE venue_name='$venue'";
    $result_dates = mysqli_query($conn, $fetch_dates);
    $row_dates = mysqli_fetch_assoc($result_dates);
    $available_from = $row_dates['available_from'] ?? ''; // Initialize with fetched value or empty string if not found
    $available_to = $row_dates['available_to'] ?? '';
    echo "From $available_from - To $available_to";
}
?>
