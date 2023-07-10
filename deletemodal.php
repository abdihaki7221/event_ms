
<head>
  <style >
  .modal-dialog {
    min-height: calc(100vh - 60px);
    display: flex;
    flex-direction: column;
    justify-content: top;
    overflow: auto;
}
@media(max-width: 768px) {
  .modal-dialog {
    min-height: calc(100vh - 20px);
  }
}
  </style>
</head>




<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">

            <div class="modal-content">



                <form action="DeleteStaff.php" method="post">

                
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"> Are you sure you want to delete?</h5>

                  </div>

                  <input type="hidden" name="delete_id" id="delete_id">

                  <div class="modal-footer">
                    <a href="event_planner_dashboard.php?manage_staff=<?php $sql = "SELECT * FROM staff";
                    $result = mysqli_query($conn,$sql);
                    while ($raw_data = mysqli_fetch_assoc($result)) {
                            $user_id  = $raw_data['staff_id'];


                             echo "$user_id";
                           } ?>"><button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button></a>
          <button type="submit" class="btn btn-danger" name="delete" data-dismiss="modal">Delete</button>
          </div>

          </form>
        </div>

                  </div>






            </div>

        </div>
    </div>
