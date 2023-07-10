<?php
include 'db_connect.php';

if (isset($_POST['venue'])) {
    $venue = $_POST['venue'];
    $fetch_price = "SELECT price FROM venues WHERE venue_name='$venue'";
    $result_price = mysqli_query($conn, $fetch_price);
    $row_price = mysqli_fetch_assoc($result_price);
    $price = $row_price['price'] ?? '';
    echo $price;
}
?>
