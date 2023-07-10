<?php
include 'db_connect.php';

// Get the form data from the AJAX request
$eventId = $_POST['eventId'];
$menu1 = $_POST['menu1'];
$menu2 = $_POST['menu2'];
$menu3 = $_POST['menu3'];
$menu4 = $_POST['menu4'];
$menu5 = $_POST['menu5'];
$menu6 = $_POST['menu6'];
$vendorEmail = $_POST['vendorEmail'];

// Check if a menu already exists for the event
$checkMenuQuery = "SELECT * FROM menus WHERE event_id = '$eventId' and vendor_email = '$vendorEmail'";
$checkMenuResult = mysqli_query($conn, $checkMenuQuery);

if (mysqli_num_rows($checkMenuResult) > 0) {
    // A menu already exists for the event
    $response = "Menu already created for this event.";
} else {
    // Perform the database insert operation
    $insertMenuQuery = "INSERT INTO menus (event_id, menu1, menu2, menu3, menu4, menu5, menu6, vendor_email) VALUES ('$eventId', '$menu1', '$menu2', '$menu3', '$menu4', '$menu5', '$menu6', '$vendorEmail')";
    $result = mysqli_query($conn, $insertMenuQuery);

    if ($result) {
        $response = "Menu created successfully!";
    } else {
        $response = "Failed to create menu.";
    }
}

echo $response;

?>
