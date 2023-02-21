<?php

function display_pop_ups(){
    date_default_timezone_set("Europe/Berlin");
    $start_time = date("H:i:s");
?>
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"> EDIT USER LOGIN / LOGOUT DATA </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>

              <form action="" method="POST">

                  <div class="modal-body">

                      <input type="hidden" name="update_id" id="update_id">

                      <div class="form-group">
                          <label> User Selected</label>
                          <input type="text" name="username" id="username" class="form-control"
                              placeholder="Edit website" readonly>
                      </div>

                      <div class="form-group">
                          <label> Edit Date  </label>
                          <input type="text" name="date_selected" id="date_selected" class="form-control"
                              placeholder="Edit Date"> 
                      </div>

                      <div class="form-group">
                          <label> Edit Starting Time </label>
                          <input type="text" name="starting_time" id="starting_time" class="form-control"
                              placeholder="Edit Starting Time" > 
                      </div>

                      <div class="form-group">
                          <label> Edit Ending Time </label>
                          <input type="text" name="ending_time" id="ending_time" class="form-control"
                              placeholder="Edit Ending Time">
                      </div>

                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" name="updatedata" class="btn btn-primary">Update Data</button>
                  </div>
              </form>

          </div>
      </div>
  </div>


  <div class="modal fade" id="updatemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"> LOG OUT </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>

              <form action="" method="POST">

                  <div class="modal-body">
                  <input type="hidden" name="update_ending_time" id="update_ending_time">
                  <div class="form-group">
                     <input type="hidden" name="end_time" id="end_time" class="form-control"  placeholder="Edit Ending Time" value="<?php echo $start_time ?>" readonly >
                  </div>
                      <h4 class="alert alert-warning"> Do you want to log out ?</h4>
                     
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"> No </button>
                      <button type="submit" id="end_working_day_btn" name="end_working_day_btn" class="btn btn-primary"> Yes </button>
                  </div>
              </form>

          </div>
      </div>
  </div>
<?php
}