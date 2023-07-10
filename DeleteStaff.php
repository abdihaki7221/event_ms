<?php
include 'db_connect.php';

    if(isset($_POST['delete']))
    {
        $id = $_POST['delete_id'];




        $query = "DELETE FROM postbank_staff

         WHERE SR_NO='$id'  ";
        $query_run = mysqli_query($conn, $query);

        if($query_run)
        {

            header("Location:event_planner_dashboard.php?manage_staff");
        }
        else
        {

        }
    }
?>
