<?php
include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Manage Orders</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">

  <style>
  .search {
    border-color: #0047AB;
  }
  .search-btn {
    border-color: #0047AB;
  }
  .search-btn:hover {
    background-color: #0047AB;
    color: #FFF;
  }
  </style>
  </head>
  <body class="body">
    <div class="row">
      <div class="col-md-5 ">

      </div>
      <div class="col-md-5 mb-0">
        <!--search btn--->
          <nav class="navbar justify-content-center">
            <form class="form-inline" method="post">
              <div class="text-start">
                <input class="form-control search mr-sm-2" style="border-color:" name="search" type="search" placeholder="Search" value="<?php echo @$_GET['search']; ?>" -label="Search">
                <button class="btn  my-2 my-sm-0 search-btn" name="search_btn" type="submit" style="">Search</button>
              </div>
            </form>
        </nav>
      </div>
    </div>
    <div class="row">
      <div class="col-3">

      </div>
      <div class="col-7 sm-4 mx-2 ms-2 " >
        <table class='table shadow-lg me-2' style="border-radius:8px;">
          <thead class='thead text-white' style='background-color: #0047AB;'>
            <tr>
              <th scope='col'>Booking ID</th>
              <th scope='col'>Event Name</th>
              <th scope='col'>Attender Email</th>
              <th scope='col'>Attendee Name</th>
              <th scope='col'>Menu</th>
              <th scope='col'>Event Date</th>
            </tr>
          </thead>
          <?php
          $limit = 100;
          $getQuery = "SELECT booked_events.booking_id, events.event_name, booked_events.attendee_email,booked_events.menu, booked_events.attendee_name
                       FROM booked_events
                       INNER JOIN events ON booked_events.event_id = events.event_id";
          $result = mysqli_query($conn, $getQuery);
          $total_rows = mysqli_num_rows($result);
          $total_pages = ceil($total_rows / $limit);
          if (!isset($_GET['page'])) {
            $page_number = 1;
          } else {
            $page_number = $_GET['page'];
          }
          $initial_page = ($page_number - 1) * $limit;

          if (isset($_POST['search_btn'])) {
            $searchKey = $_POST['search'];
            $sql = "SELECT booked_events.booking_id, events.event_name, booked_events.attendee_email,booked_events.menu, booked_events.attendee_name
                    FROM booked_events
                    INNER JOIN events ON booked_events.event_id = events.event_id
                    WHERE (booked_events.booking_id LIKE '%$searchKey%') OR
                          (events.event_name LIKE '%$searchKey%') OR
                          (booked_events.attendee_email LIKE '%$searchKey%') OR
                          (booked_events.attendee_name LIKE '%$searchKey%')";
            $result = mysqli_query($conn, $sql);
          }

          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>".$row['booking_id']."</td>";
            echo "<td>".$row['event_name']."</td>";
            echo "<td>".$row['attendee_email']."</td>";
            echo "<td>".$row['attendee_name']."</td>";
            echo "<td>".$row['menu']."</td>";
            echo "<td>Event Date</td>";
            echo "</tr>";
          }
          ?>
        </table>
      </div>
    </div>
  </body>
</html>
