<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://julianmuslia.com
 * @since      1.0.0
 *
 * @package    Working_Hours_Pg
 * @subpackage Working_Hours_Pg/admin/partials
 */


// This file should primarily consist of HTML with a little bit of PHP.
include_once("save_working_day.php");
save_working_day ();
include_once("pop_ups.php");
display_pop_ups();
update_working_day();
update_working_day_as_admin();
date_default_timezone_set("Europe/Berlin");
function WorkingHoursUI() { 
    $current_user = wp_get_current_user(); 
    $user = $current_user->display_name; 
    $start_date = date("Y-m-d");
    $start_time = date("H:i:s");
    ?>

<div class="container-fluid">
    <br>
    <h2 class="text-center" style="font-family: 'Roboto', sans-serif;"><span style="color:#DE0A2B">Publishing Group</span> Workday</h2>
	<br>
    <br>    

    <table class="table table-success">

    <tbody>
    <tr style="background-color:#fff; " >
		<th scope="row">-></th>
        <td> <span style="color:#ff0000"><?php echo  $user;?></span></td>
		<td><form method="post"><div class="form-group"><input type="date" id="work_date" name="work_date" value="<?php echo $start_date ?>" readonly></div></td>
		<td><div class="form-group"><input type="time" id="start_time" name="start_time" value="<?php echo $start_time ?>" readonly></div></td> 
		<td><div class="form-group"><input type="time" id="end_time" name="end_time" ></td>
		<td><div class="form-group"> <button type="submit" class="btn btn-primary" name="save_work_day" id="save_work_day">Save</button></div></form></td>
        <td></td>
    </tr>
    </tbody>
    </table>
    <table id="datatableid" class="table table-success">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">User</th>
                <th scope="col">Date</th>
                <th scope="col">Starting Time</th>
                <th scope="col">Ending Time</th>
                <th scope="col">Total Time</th>
                <th scope="col">Save / Edit</th>
                
            </tr>
        </thead>
        <tbody>
        
    <?php 
   	global $wpdb;
   	$table_name = $wpdb->prefix . "working_hours_pg";
    $user = $current_user->display_name;
	$results_admin = $wpdb->get_results("Select * from $table_name");
    $results_editor = $wpdb->get_results("Select * from $table_name where username = '$user'");
  
    if ( current_user_can('administrator')){
        if ($results_admin){
            foreach ($results_admin as $row){
    ?>	
        <tr>
            <td> <?php echo $row->id; ?></td>
            <td> <?php echo $row->username; ?></td>
            <td> <?php echo $row->workday_date; ?></td>
            <td> <?php echo $row->start_time; ?></td>
            <td> <?php echo $row->end_time; ?></td>
            <td><?php echo $row->total_time ?></td> 
            <!-- <td> <?php ?></td> -->
            <td><button type="button" class="btn btn-danger edit_btn" > EDIT </button>
                <?php if ($row->total_time > "00:00:00" ) {
                        echo '<button type="submit" class="btn btn-dark"> Already Logged out </button>';   
                         }
                        else 
                        echo '<button type="submit" class="btn btn-secondary save_work_day_off"> Exit work </button>';
                 ?> 
                
             
            </td>
        </tr>
            <?php
            }
        }     
    }
    else
        if ($results_editor){
            foreach ($results_editor as $row){

    ?>	
        <tr>
            <td> <?php echo $row->id; ?></td>
            <td> <?php echo $row->username; ?></td>
            <td> <?php echo $row->workday_date; ?></td>
            <td> <?php echo $row->start_time; ?></td>
            <td> <?php echo $row->end_time; ?></td>
            <td> <?php echo $row->total_time?></td>
            <td> <?php if ($row->total_time > "00:00:00" ) {
                        echo '<button type="submit" class="btn btn-dark"> Already Logged out </button>';   
                         }
                        else 
                        echo '<button type="submit" class="btn btn-secondary save_work_day_off"> Exit work </button>';
                 ?>
            </td>
            <td></td>
        </tr>
            <?php

            }
        }     

    ?>
	  
	</tbody>
	<tfoot>
	  <tr>
		<td colspan="4" style="background-color:#FFFFFF!important; border:0px"></td>
		<td>TOTAL Hours</td>
		<td><?php 
            $total_time_sum = $wpdb->get_results("Select total_time from $table_name where username = '$user'");
            $monthly_total = 0;
            if ($total_time_sum){
                foreach ($total_time_sum as $row){
                 $str_time = $row->total_time; 
                 sscanf($str_time, "%d:%d:%d", $hours,$minutes,$seconds);
                 $time_seconds_total = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;

                 $monthly_total += $time_seconds_total;
                 
                }
                 echo '<strong>'.$monthly_total_hours =   gmdate("H:i:s", $monthly_total).'</strong>';
            }

        ?></td>
	  </tr>
	</tfoot>
    </table>


</div>
  <script>

$(document).ready(function () {

    $('#datatableid').DataTable({
       "pagingType": "full_numbers",
       "pageLength": 31,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        responsive: true,
        language: {
           // search: "_INPUT_",
           // searchPlaceholder: "Search Password",
        }
    });


});
</script>



<script>
    
    $(document).ready(function () {

        $('#datatableid tbody').on('click', '.edit_btn', function () {

            $('#editmodal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#update_id').val(data[0]);
            $('#username').val(data[1]);
            $('#date_selected').val(data[2]);
            $('#starting_time').val(data[3]);
            $('#ending_time').val(data[4]);
            
        });
    });    
    </script>

<script>
      $(document).ready(function () {

          $('.save_work_day_off').on('click', function () {

              $('#updatemodal').modal('show');

              $tr = $(this).closest('tr');

              var data = $tr.children("td").map(function () {
                  return $(this).text();
              }).get();

              console.log(data);

              $('#update_ending_time').val(data[0]);

          });
      });
  </script>

<?php

	}