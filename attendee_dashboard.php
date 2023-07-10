<?php
include 'db_connect.php';
include 'head.php';

$username = $_SESSION['username'];

// Fetch event data from the database
$select_events = "SELECT * FROM events";
$result = mysqli_query($conn, $select_events);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
</head>
<body>



  <div class="container text-center mt-5">
    <div class="row">
      <div class="col-md-3"></div>
      <?php
          while ($event_data = mysqli_fetch_assoc($result)) {
              $event_id = $event_data['event_id'];
              $event_name = $event_data['event_name'];
              $venue_name = $event_data['venue_name'];
              $date = $event_data['event_date'];
              $start_time = $event_data['start_time'];
              $end_time = $event_data['end_time'];
              $price = $event_data['ticket_fee'];
              $venue_image = $event_data['venue_image'];
              ?>

              <div class="col-md-3 ms-3">
                <div class="card" style="width: 14rem;">
                  <img src="uploads/<?php echo $venue_image; ?>" class="card-img-top" style="height: 8rem;" alt="Event Image">

                  <div class="card-body">
                    <p class="card-text"><?php echo "Event: $event_name"; ?></p>
                    <p class="card-text"><?php echo "Venue: $venue_name"; ?></p>
                    <p class="card-text"><?php echo "Date: $date"; ?></p>
                    <p class="card-text"><?php echo "Time: $start_time - $end_time"; ?></p>
                    <p class="card-text"><?php echo "Price: Ksh $price"; ?></p>
                    <a href="#" class="btn btn-primary" id="addMenuBtn">Book Event</a>
                  </div>
                </div>
              </div>

          <?php
          }
          ?>
    </div>
  </div>


  <!-- Add Menu Modal -->
  <div class="modal fade" id="addMenuModal" tabindex="-1" role="dialog" aria-labelledby="addMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addMenuModalLabel">Book Menu</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Menu input fields -->
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" value="<?php echo $name; ?>" readonly name="name" required="required">
          </div>
          <div class="form-group">
            <label for="email">Email </label>
            <input type="email" class="form-control" id="email" value="<?php echo $username; ?>" readonly name="email" required="required">
          </div>

          <div class="form-group">
            <label for="menuSelect">Select Menu</label>
            <select class="form-control" id="menuSelect" name="menuSelect" required="required">
              <option value="">Select Menu</option>
              <?php
              $select_menus = "SELECT menu1, menu2, menu3, menu4, menu5, menu6 FROM menus WHERE event_id = $event_id";
              $result_menus = mysqli_query($conn, $select_menus);
              $menu_data = mysqli_fetch_assoc($result_menus);

              for ($i = 1; $i <= 6; $i++) {
                $menu = $menu_data['menu' . $i];
                if (!empty($menu)) {
                  echo "<option value='$menu'>$menu</option>";
                }
              }
              ?>
            </select>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="createMenuBtn" name="Book">Book</button>
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
        var name = $('#name').val();
        var email = $('#email').val();
        var eventId = '<?php echo $event_id; ?>';
        var menuSelect = $('#menuSelect').val();

        if (menuSelect.trim() === '') {
          alert('Please select a menu.');
          return;
        }

        $.ajax({
    url: 'book_menu.php',
    method: 'POST',
    data: {
      eventId: eventId,
      name: name,
      email: email,
      menuSelect: menuSelect,

    },
    success: function(response) {
      alert(response);
      $('#addMenuModal').modal('hide');
      $('#addMenuBtn').attr('disabled', 'disabled');
    }
  });

      });
    });
  </script>
</body>
</html>
