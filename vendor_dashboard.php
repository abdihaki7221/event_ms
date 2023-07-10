<?php
include 'db_connect.php';
include 'head.php';

$username = $_SESSION['username'];

// Fetch event data from the database
$select_events = "SELECT * FROM events where vendor_email = '$username'";
$result = mysqli_query($conn, $select_events);
$event_data = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

<?php
if (!empty($event_data)) {
    $event_name = $event_data['event_name'];
    $venue_name = $event_data['venue_name'];
    $date = $event_data['event_date'];
    $start_time = $event_data['start_time'];
    $end_time = $event_data['end_time'];
?>

    <div class="container text-center mt-5">
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3">
          <div class="card" style="width: 16rem;">
            <img src="uploads/<?php echo $event_data['venue_image']; ?>" class="card-img-top" alt="...">
            <div class="card-body">
              <p class="card-text"><?php echo $event_name; ?></p>
              <p class="card-text"><?php echo $venue_name; ?></p>
              <p class="card-text"><?php echo $date; ?></p>
              <p class="card-text"><?php echo $start_time; ?> - <?php echo $end_time; ?></p>
              <a href="#" class="btn btn-primary" id="addMenuBtn">Add Menu</a>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php
}
?>


    <!-- Add Menu Modal -->
   <div class="modal fade" id="addMenuModal" tabindex="-1" role="dialog" aria-labelledby="addMenuModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="addMenuModalLabel">Add Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
           <!-- Menu input fields -->
           <div class="form-group">
             <label for="menu1">Menu 1</label>
             <input type="text" class="form-control" id="menu1" name="menu1" required = "required">
           </div>
           <div class="form-group">
             <label for="menu2">Menu 2</label>
             <input type="text" class="form-control" id="menu2" name="menu2" required = "required">
           </div>
           <div class="form-group">
             <label for="menu3">Menu 3</label>
             <input type="text" class="form-control" id="menu3" name="menu3" required = "required">
           </div>
           <div class="form-group">
             <label for="menu4">Menu 4</label>
             <input type="text" class="form-control" id="menu4" name="menu4" required = "required">
           </div>
           <div class="form-group">
             <label for="menu5">Menu 5</label>
             <input type="text" class="form-control" id="menu5" name="menu5" required = "required">
           </div>
           <div class="form-group">
             <label for="menu6">Menu 6</label>
             <input type="text" class="form-control" id="menu6" name="menu6" required = "required">
           </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
           <button type="button" class="btn btn-primary" id="createMenuBtn">Create Menu</button>
         </div>
       </div>
     </div>
   </div>



   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function() {
        $('#addMenuBtn').click(function() {
          $('#addMenuModal').modal('show');
        });

        $('#createMenuBtn').click(function() {
          var eventId = '<?php echo $event_data['event_id']; ?>';
          var menu1 = $('#menu1').val();
          var menu2 = $('#menu2').val();
          var menu3 = $('#menu3').val();
          var menu4 = $('#menu4').val();
          var menu5 = $('#menu5').val();
          var menu6 = $('#menu6').val();
          var vendorEmail = '<?php echo $_SESSION['username']; ?>';

          if (menu1.trim() === '' || menu2.trim() === '' || menu3.trim() === '' || menu4.trim() === '' || menu5.trim() === '' || menu6.trim() === '') {
      alert('Please fill in all menu fields.');
      return;
    }

          $.ajax({
            url: 'create_menu.php',
            method: 'POST',
            data: {
              eventId: eventId,
              menu1: menu1,
              menu2: menu2,
              menu3: menu3,
              menu4: menu4,
              menu5: menu5,
              menu6: menu6,
              vendorEmail: vendorEmail
            },
            success: function(response) {
              alert(response);
              $('#addMenuModal').modal('hide');
            }
          });
        });
      });
    </script>
  </body>
</html>

  </body>
</html>
