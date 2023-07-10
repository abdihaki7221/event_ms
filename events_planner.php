<?php
include 'db_connect.php';
include 'head.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
  <!-- Include CSS files for DataTables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-3">
      </div>
      <div class="col-md-7">
        <!-- Create a table with fields booking_id, event Name, attender email, attendee name -->
        <table id="bookingTable" class="table table-bordered table-striped">
          <thead class="bg-primary text-white">
            <tr>
              <th>Booking ID</th>
              <th>Event Name</th>
              <th>Attender Email</th>
              <th>Attendee Name</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Retrieve data from booked_events table
            $username = $_SESSION['username'];
            $query = "SELECT booking_id, event_name, attendee_email, attendee_name FROM booked_events
                      INNER JOIN events ON booked_events.event_id = events.event_id
                      WHERE events.planner_email = '$username'";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
              $booking_id = $row['booking_id'];
              $event_name = $row['event_name'];
              $attender_email = $row['attendee_email'];
              $attendee_name = $row['attendee_name'];
              echo "
              <tr>
                <td>$booking_id</td>
                <td>$event_name</td>
                <td>$attender_email</td>
                <td>$attendee_name</td>
              </tr>";
            }
            ?>
          </tbody>
        </table>
        <!-- Add a search field to search through the table data and pagination also -->
      
      </div>
    </div>
  </div>

  <!-- Include jQuery and DataTables JavaScript libraries -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
  <script>
    $(document).ready(function() {
      // Initialize DataTable with options
      var table = $('#bookingTable').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "pageLength": 10, // Number of rows to display per page
        "language": {
          "search": "Search: ",
          "paginate": {
            "previous": "Previous",
            "next": "Next"
          }
        }
      });

      // Add search functionality
      $('#searchInput').on('keyup', function() {
        table.search(this.value).draw();
      });
    });
  </script>
</body>
</html>
