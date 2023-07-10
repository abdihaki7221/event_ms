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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <style >


    .body{
      font-size:22px;
    }
  </style>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">


  </head>
  <body class="body" >
    <div class="row">
      <div class="col-3">

      </div>
      <div class="col-md-4 mt-4">
        <!--search btn--->
          <nav class="navbar justify-content-start">
            <div class="text-start " >
              <button   id="btn-download" type="button" name="button" class="btn" style="background-color:#0047AB">
                <i class="fa-solid fa-download text-light" style="font-size:30px;"></i></button>
            </div>
            <div class="text-start ms-2" >
              <button onclick="printDiv('table_in_service')"   type="button" id="btn-print" name="btn-print" class="btn" style="background-color:#000">
                <i class="fa-solid fa-print text-light " style="font-size:30px;"></i></button>

            </div>
        </nav>
      </div>
      <div class="col-md-5 mt-3">






      </div>
    </div>
    <div class="row">


      <div class="col-3">

      </div>

      <div class="col-3 sm-4  mt-2 " id="table_in_service" >


        <table  class='table shadow-lg'  style="border-radius:8px;">
      <thead class='thead text-white' style='background-color: #0047AB;'>
        <tr>
          <th scope='col'>SR_NO:</th>
          <th scope='col'>Firstname</th>
          <th scope='col'>Surname</th>
          <th scope='col'>Middlename</th>
          <th scope='col'>Branch</th>
          <th scope='col'>Region</th>
          <th scope='col'>start_date</th>
          <th scope='col'>end_date</th>
          <th scope='col'>job_status</th>

        </tr>
      </thead>

        <?php

        $sql = "SELECT * FROM postbank_staff WHERE job_status='Terminated' ORDER BY start_date DESC";
        $result = mysqli_query($conn,$sql);
        while ($raw_data = mysqli_fetch_assoc($result)) {
                $SR_NO = $raw_data['SR_NO'];
                 $Firstname = $raw_data['Firstname'];
                 $Surname = $raw_data['Surname'];
                  $Middlename = $raw_data['Middlename'];
                  $Branch = $raw_data['Branch'];
                  $Region = $raw_data['Region'];
                  $start_date = $raw_data['start_date'];
                  $end_date = $raw_data['end_date'];
                  $job_status = $raw_data['job_status'];

                    echo "
                  <tbody>
                  <tr>
                    <td>$SR_NO</td>
                    <td>$Firstname</td>
                    <td>$Surname</td>
                    <td>$Middlename</td>
                    <td>$Branch</td>
                    <td>$Region</td>
                    <td>$start_date</td>
                    <td>$end_date</td>
                    <td>$job_status</td>





                  </tr>

                </tbody>



                      ";

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
    document.getElementById('btn-download').onclick = function(){
      var element = document.getElementById('table_in_service');
      var opt = {
        margin:       0,
        filename:     'myfile.pdf',
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 2 },
        jsPDF:        { unit: 'in', format: 'letter', orientation: 'landscape' }
      };

      html2pdf(element,opt);


    }

    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>

    <!-- jsPDF library -->
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
