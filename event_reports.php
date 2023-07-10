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
      <table class='table shadow-lg' style="border-radius:8px;">
        <thead class='thead text-white' style='background-color: #0047AB;'>
          <tr>
            <th scope='col'>event id :</th>
            <th scope='col'>event name</th>
            <th scope='col'>vendor email</th>
            <th scope='col'>venue name</th>
            <th scope='col'>Booked No</th>
            <th scope='col'>Total Fee</th>
            <th scope='col'>event date</th>
          </tr>
        </thead>
        <?php
        $username = $_SESSION['username'];

        $sql = "SELECT * FROM events WHERE planner_email = '$username'";
        $result = mysqli_query($conn, $sql);
        while ($raw_data = mysqli_fetch_assoc($result)) {
          $event_id = $raw_data['event_id'];
          $event_name = $raw_data['event_name'];
          $vendor_email = $raw_data['vendor_email'];
          $venue_name = $raw_data['venue_name'];

          // Fetch booked_no from booked_events table
          $booked_no_query = "SELECT COUNT(*) AS booked_no FROM booked_events WHERE event_id = $event_id";
          $booked_no_result = mysqli_query($conn, $booked_no_query);
          $booked_no_data = mysqli_fetch_assoc($booked_no_result);
          $booked_no = $booked_no_data['booked_no'];

          // Fetch price from events table
          $price = $raw_data['ticket_fee'];

          $total_fee = $booked_no * $price;
          $event_date = $raw_data['event_date'];

          echo "
            <tbody>
              <tr>
                <td>$event_id</td>
                <td>$event_name</td>
                <td>$vendor_email</td>
                <td>$venue_name</td>
                <td>$booked_no</td>
                <td>$total_fee</td>
                <td>$event_date</td>
              </tr>
            </tbody>";
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
