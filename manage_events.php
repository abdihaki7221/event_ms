<?php
include 'db_connect.php';

// Delete event
if (isset($_POST['delete_btn'])) {
    $event_id = $_POST['event_id'];
    $deleteQuery = "DELETE FROM events WHERE event_id = $event_id";
    $deleteResult = mysqli_query($conn, $deleteQuery);
    if (!$deleteResult) {
        die('Query execution failed: ' . mysqli_error($conn));
    }
}


if (isset($_POST['update_btn'])) {
    $event_id = $_POST['event_id'];
    $event_name = $_POST['event_name'];
    $venue_name = $_POST['venue_name'];
    $event_date = $_POST['event_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    $updateQuery = "UPDATE events SET event_name = '$event_name', venue_name = '$venue_name', event_date = '$event_date', start_time = '$start_time', end_time = '$end_time' WHERE event_id = $event_id";
    $updateResult = mysqli_query($conn, $updateQuery);
    if (!$updateResult) {
        die('Query execution failed: ' . mysqli_error($conn));
    }
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Manage Events</title>

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
                    <input class="form-control search mr-sm-2" style="border-color:" name="search" type="search"
                           placeholder="Search" value="<?php echo @$_GET['search']; ?>" -label="Search">
                    <button class="btn  my-2 my-sm-0 search-btn" name="search_btn" type="submit" style="">Search
                    </button>
                </div>
            </form>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-3">

    </div>
    <div class="col-7 sm-4 mx-2 ms-2 ">
        <table class='table shadow-lg me-2' style="border-radius:8px;">
            <thead class='thead text-white' style='background-color: #0047AB;'>
            <tr>
                <th scope='col'>Event ID</th>
                <th scope='col'>Event Name</th>
                <th scope='col'>Venue Name</th>
                <th scope='col'>Event Date</th>
                <th scope='col'>Start Time</th>
                <th scope='col'>End Time</th>
                <th scope='col'>Edit</th>
                <th scope='col'>Delete</th>
            </tr>
            </thead>
            <?php
            $limit = 100;
            $getQuery = "SELECT * FROM events";
            $result = mysqli_query($conn, $getQuery);
            if (!$result) {
                die('Query execution failed: ' . mysqli_error($conn));
            }
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
                $getQuery = "SELECT * FROM events WHERE
                                event_id LIKE '%$searchKey%' OR
                                event_name LIKE '%$searchKey%' OR
                                venue_name LIKE '%$searchKey%' OR
                                event_date LIKE '%$searchKey%' OR
                                start_time LIKE '%$searchKey%' OR
                                end_time LIKE '%$searchKey%'
                                LIMIT $initial_page, $limit";
                $result = mysqli_query($conn, $getQuery);
                if (!$result) {
                    die('Query execution failed: ' . mysqli_error($conn));
                }
            } else {
                $getQuery = "SELECT * FROM events LIMIT $initial_page, $limit";
                $result = mysqli_query($conn, $getQuery);
                if (!$result) {
                    die('Query execution failed: ' . mysqli_error($conn));
                }
            }

            while ($row = mysqli_fetch_array($result)) {
                echo "
                    <tr>
                        <td>" . $row['event_id'] . "</td>
                        <td>" . $row['event_name'] . "</td>
                        <td>" . $row['venue_name'] . "</td>
                        <td>" . $row['event_date'] . "</td>
                        <td>" . $row['start_time'] . "</td>
                        <td>" . $row['end_time'] . "</td>
                        <td><button class='btn btn-primary' onclick=\"openEditModal(
                          '" . $row['event_id'] . "',
                          '" . $row['event_name'] . "',
                          '" . $row['venue_name'] . "',
                          '" . $row['event_date'] . "',
                          '" . $row['start_time'] . "',
                          '" . $row['end_time'] . "'
                          )\">Edit</button></td>


                        <td>
                            <button class='btn btn-danger' onclick=\"openDeleteModal(
                                '" . $row['event_id'] . "',
                                '" . $row['event_name'] . "'
                            )\">Delete</button>

                        </td>
                    </tr>";
            }
            ?>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <?php
                if ($page_number > 1) {
                    echo "<li class='page-item'><a class='page-link' href='manage_events.php?page=" . ($page_number - 1) . "'>Previous</a></li>";
                }

                for ($i = 1; $i <= $total_pages; $i++) {
                    echo "<li class='page-item'><a class='page-link' href='manage_events.php?page=" . $i . "'>" . $i . "</a></li>";
                }

                if ($page_number < $total_pages) {
                    echo "<li class='page-item'><a class='page-link' href='manage_events.php?page=" . ($page_number + 1) . "'>Next</a></li>";
                }
                ?>
            </ul>
        </nav>
    </div>
</div>

<!-- Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <input type="hidden" id="event_id" name="event_id" value="">
                            <div class="form-group">
                                <label for="event_name">Event Name</label>
                                <input type="text" class="form-control" id="event_name" name="event_name" required>
                            </div>
                            <div class="form-group">
                                <label for="venue_name">Venue Name</label>
                                <input type="text" class="form-control" id="venue_name" name="venue_name" required>
                            </div>
                            <div class="form-group">
                                <label for="event_date">Event Date</label>
                                <input type="date" class="form-control" id="event_date" name="event_date" required>
                            </div>
                            <div class="form-group">
                                <label for="start_time">Start Time</label>
                                <input type="time" class="form-control" id="start_time" name="start_time" required>
                            </div>
                            <div class="form-group">
                                <label for="end_time">End Time</label>
                                <input type="time" class="form-control" id="end_time" name="end_time" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="update_btn">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
      <p id="confirmationText"></p>
  </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form method='post' style='display: inline;'>
                    <input type='hidden' id='event_id' name='event_id' value=''>
                    <button type='submit' class='btn btn-danger' name='delete_btn'>Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

<script>
    function openEditModal(event_id, event_name, venue_name, event_date, start_time, end_time) {
        document.getElementById('event_id').value = event_id;
        document.getElementById('event_name').value = event_name;
        document.getElementById('venue_name').value = venue_name;
        document.getElementById('event_date').value = event_date;
        document.getElementById('start_time').value = start_time;
        document.getElementById('end_time').value = end_time;
        $('#editModal').modal('show');
    }
</script>
<script>
    function openDeleteModal(eventId, eventName) {
        document.getElementById('event_id').value = eventId;
        document.getElementById('event_name').textContent = eventName;
        document.getElementById('confirmationText').textContent = "Are you sure you want to delete the event: " + eventName + "?";
        $('#deleteModal').modal('show');
    }
</script>


</body>
</html>
