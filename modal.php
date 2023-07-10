




<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Update Staff Details </h5>
                    <a href="event_planner_dashboard.php?manage_staff=<?php $sql = "SELECT * FROM staff";
                    $result = mysqli_query($conn,$sql);
                    while ($raw_data = mysqli_fetch_assoc($result)) {
                            $user_id  = $raw_data['staff_id'];


                             echo "$user_id";
                           } ?>"><button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button></a>
                </div>




                <form action="update_staff.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="update_id" id="update_id">

                        <div class="form-group">
                            <label> Full Name </label>
                            <input type="text" name="Fullname" id="Fullname" class="form-control"
                                value="Enter Fullname">
                        </div>




                        <div class="form-group">
                            <label> Branch </label>
                            <select name="Branch" id="Branch" class="form-control selectpicker" data-live-search="true" >


                              <?php
                              $select_branches = "SELECT * FROM branches ORDER BY branch_name ASC";
                              $exec_query = mysqli_query($conn,$select_branches);
                              while ($fetch_data = mysqli_fetch_assoc($exec_query)) {
                                $branch_name = $fetch_data['branch_name'];
                                echo "    <option value='$branch_name'>$branch_name</option>";
                              }


                               ?>


                            </select>
                        </div>

                        <div class="form-group">
                            <label> Region </label>
                            <select name="Region" id="Region" class="form-control selectpicker mt-1" data-live-search="true" >

                              <?php
                              $select_regions = "SELECT * FROM regions ORDER BY region_name ASC ";
                              $exec_query = mysqli_query($conn,$select_regions);
                              while ($fetch_data = mysqli_fetch_assoc($exec_query)) {
                                $region_name = $fetch_data['region_name'];
                                echo "<option value='$region_name'>$region_name</option>";
                              }


                               ?>

                            </select>
                        </div>
                        <input type="hidden" name="start_date" id="start_date" value="">

                        <div class="form-group">
                            <label> end date </label>
                            <input type="date" name="end_date" id="end_date" class="form-control"
                                placeholder="Enter Region">
                        </div>

                        <div class="form-group">
                            <label> job status </label>
                            <select  name="job_status" id="job_status" class="form-control  mt-1">
                              <option value="In-Service">In-Service</option>
                              <option value="Terminated">Terminated</option>
                              <option value="Resigned">Resigned</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                      <a href="event_planner_dashboard.php?manage_staff=<?php $sql = "SELECT * FROM staff";
                      $result = mysqli_query($conn,$sql);
                      while ($raw_data = mysqli_fetch_assoc($result)) {
                              $user_id  = $raw_data['staff_id'];


                               echo "$user_id";
                             } ?>"><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button></a>
                        <button type="submit" name="updatedata" class="btn btn-primary">Update Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
