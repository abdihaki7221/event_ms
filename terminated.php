<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">

  <style>
  .search{
  border-color:#0047AB;

  }
  .search-btn{
    border-color:#0047AB;
  }
  .search-btn:hover{
    background-color: #0047AB;
    color: #FFF;
  }
  </style>
  </head>
  <body class="body">
    <div class="row">
      <div class="col-md-7 ">

      </div>
      <div class="col-md-5 ">
        <!--search btn--->
          <nav class="navbar justify-content-center">
            <form class="form-inline"  method="post">
              <div class="text-start">
                <input class="form-control search mr-sm-2" style="border-color:" name="search" type="search" placeholder="Search"  value="<?php echo @$_GET['search']; ?>" -label="Search">
                <button class="btn  my-2 my-sm-0 search-btn" name="search_btn" type="submit" style="">Search</button>
              </div>
            </form>
        </nav>





      </div>
    </div>
    <div class="row">
      <div class="col-3">

      </div>
      <div class="col-7 sm-4 mx-2 mt-1 " >


        <table class='table shadow-lg me-2' style="border-radius:8px;">
      <thead class='thead text-white' style='background-color: #0047AB;'>
        <tr>
          <th scope='col'>SR_NO:</th>
          <th scope='col'>Firstname</th>
          <th scope='col'>Middlename</th>
          <th scope='col'>Surname</th>
          <th scope='col'>Branch</th>
          <th scope='col'>Region</th>
          <th scope='col'>start_date</th>
          <th scope='col'>end_date</th>
          <th scope='col'>job_status</th>
          <th scope='col'>Edit</th>
        </tr>
      </thead>


      <tbody style='space: nowrap;'>


        <?php



        if(isset($_POST['search_btn'])){
           $searchKey = $_POST['search'];
           $sql = "SELECT *  FROM postbank_staff WHERE job_status='Terminated' AND (SR_NO LIKE  '%$searchKey%')
           OR (Firstname LIKE  '%$searchKey%') OR (Middlename LIKE  '%$searchKey%')OR (Surname LIKE  '%$searchKey%') ";
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


                     <tr>
                     <td>$SR_NO</td>
                     <td>$Firstname</td>
                     <td>$Middlename</td>
                     <td>$Surname </td>
                     <td>$Branch</td>
                     <td>$Region</td>
                     <td>$start_date</td>
                     <td>$end_date</td>
                     <td>$job_status</td>

                   <td><button type='button' class='btn btn-success editbtn' style='background-color:#0047AB;'>
                    <i class='fa-solid fa-pen-to-square'></i> </button></td>



                     </tr>





                         ";

                     }
        }else {
          $sql = "SELECT *  FROM postbank_staff where job_status = 'Terminated' ORDER BY start_date DESC";
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

                    <tr>
                      <td>$SR_NO</td>
                      <td>$Firstname</td>
                      <td>$Middlename</td>
                      <td>$Surname </td>
                      <td>$Branch</td>
                      <td>$Region</td>
                      <td>$start_date</td>
                      <td>$end_date</td>
                      <td>$job_status</td>

                  <td><button type='button' class='btn btn-success editbtn' style='background-color:#0047AB;'>
                   <i class='fa-solid fa-pen-to-square'></i> </button></td>



                    </tr>





                        ";

                    }
        }


         ?>
         </tbody>
         </table >

      </div>
    </div>


    <?php include('terminated_modal.php');?>

    <script>
        $(document).ready(function () {

            $('.editbtn').on('click', function () {

                $('#terminated_modal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#update_id').val(data[0]);
                $('#Firstname').val(data[1]);
                $('#Middlename').val(data[2]);
                $('#Surname').val(data[3]);
                $('#Branch').val(data[4]);
                $('#Region').val(data[5]);
                $('#start_date').val(data[6]);
                $('#end_date').val(data[7]);
                $('#job_status').val(data[8]);

            });
        });

    </script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
  </body>
</html>
