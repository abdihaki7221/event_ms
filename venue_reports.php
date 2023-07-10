<?php
include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

  <!-- jQuery library -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>

  <!-- Popper JS -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    .body {
      font-size: 22px;
    }
  </style>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
</head>

<body class="body">
  <div class="row">
    <div class="col-3">

    </div>
    <div class="col-md-4 mt-4">
      <!--search btn--->
      <nav class="navbar justify-content-start">

        <div class="text-start">
          <button onclick="printDiv('table_in_service')" type="button" id="btn-print" name="btn-print" class="btn" style="background-color:#000">
            <i class="fa-solid fa-print text-light " style="font-size:30px;"></i>
          </button>
        </div>
      </nav>
    </div>
    <div class="col-md-5 mt-3">
    </div>
  </div>
  <div class="row">
    <div class="col-3">
    </div>
    <div class="col-3 sm-4  mt-2 " id="table_in_service">
      <table class='table shadow-lg me-2' id="table_in_service" style="border-radius:8px;">
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

  <script type="text/javascript">
    function printDiv(divName) {
      var printContents = document.getElementById(divName).innerHTML;
      var originalContents = document.body.innerHTML;

      document.body.innerHTML = printContents;

      window.print();

      document.body.innerHTML = originalContents;
    }
  </script>

  <script type="text/javascript">
    document.getElementById('btn-download').onclick = function() {
      var element = document.getElementById('table_in_service');
      var opt = {
        margin: 0,
        filename: 'myfile.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'letter', orientation: 'landscape' }
      };

      html2pdf(element, opt);
    }
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
  <script src="js/jsPDF/dist/jspdf.umd.js"></script>
  <script src="custom.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
</body>
</html>
