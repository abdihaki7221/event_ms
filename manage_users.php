<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div class="row">
      <div class="col-3">

      </div>
      <div class="col-8 sm-4 mx-2 mt-4 " >


        <table class='table shadow-lg'style="border-radius:6px;">
      <thead class='thead text-white' style='background-color: #0047AB;'>
        <tr>
          <th scope='col'>#NO:</th>
          <th scope='col'>HR Staff Name</th>
          <th scope='col'>HR Staff Email</th>
          <th scope='col'>Branch</th>
          <th scope='col'>Edit</th>
          <th scope='col'>Remove</th>
        </tr>
      </thead>

        <?php

        $sql = "SELECT * FROM staff";
        $result = mysqli_query($conn,$sql);
        while ($raw_data = mysqli_fetch_assoc($result)) {
                $staff_id  = $raw_data['staff_id'];
                 $staff_name = $raw_data['staff_name'];
                 $staff_email = $raw_data['username'];
                  $branch_name = $raw_data['branch_name'];


                    echo "
                  <tbody>
                  <tr>
                    <th scope='row'>$staff_id</th>
                    <td>$staff_name</td>
                    <td>$staff_email</td>
                    <td>$branch_name</td>
                    <td>
                    <a href = 'user_edit.php?user_id= $staff_id''><i class='fa-solid fa-user-pen' style='font-size: 22px;'></i></a>

                    </a>
                    </td>
                    <td>
                    <div class='text-center'>
                 <a href='delete.php?delete_id=$staff_id'>
                  <i class='fa-solid fa-user-xmark text-danger' style='font-size: 22px;'></i></a>
                  </div>


                    </td>
                  </tr>

                </tbody>



                      ";

                  }
         ?>
         </table>

      </div>
    </div>

  </body>
</html>
