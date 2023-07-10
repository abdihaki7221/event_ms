<?php
include 'db_connect.php';

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Manage Bookings</title>

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
      <div class="col-md-5 mb-0 mt-3">
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
              <th scope='col'>Planner Email</th>

              <th scope='col'>Venue Name</th>
              <th scope='col'>Event Date</th>
              <th scope='col'>Start Time</th>
              <th scope='col'>End Time</th>
              <th scope='col'>Price</th>

            </tr>
          </thead>
          <?php
          $limit = 100;
          $getQuery = "SELECT * FROM booked_venues";
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
            $sql = "SELECT * FROM booked_venues WHERE
              (event_id LIKE '%$searchKey%') OR
              (planner_email LIKE '%$searchKey%') OR
              (venue_email LIKE '%$searchKey%') OR
              (venue_name LIKE '%$searchKey%') OR
              (event_date LIKE '%$searchKey%') OR
              (start_time LIKE '%$searchKey%') OR
              (end_time LIKE '%$searchKey%') OR
              (price LIKE '%$searchKey%')";
            $result = mysqli_query($conn, $sql);
          }

          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>".$row['event_id']."</td>";
            echo "<td>".$row['planner_email']."</td>";

            echo "<td>".$row['venue_name']."</td>";
            echo "<td>".$row['event_date']."</td>";
            echo "<td>".$row['start_time']."</td>";
            echo "<td>".$row['end_time']."</td>";
            echo "<td> Ksh ".$row['price']."</td>";

            echo "</tr>";
          }
          ?>
        </table>
      </div>
    </div>
  </body>
</html>
