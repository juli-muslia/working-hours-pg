<?php

function save_working_day () {
    global $wpdb;
    $table = $wpdb->prefix . "working_hours_pg";
    $current_user = wp_get_current_user(); 

    if (isset($_POST['save_work_day'])) {
        $user = $current_user->display_name;
        $working_date = $_POST['work_date'];
        $starting_time = $_POST['start_time'];
        $ending_time =  $_POST['end_time'];
        $total_time = 0;

        $results = $wpdb->query("INSERT INTO $table (username,workday_date,start_time,end_time,total_time) values('$user','$working_date','$starting_time','$ending_time','$total_time')");
        
        if ($results) {
            echo '<div class="alert alert-success text-center" role="alert">
        <h3>Data Saved successfully !</h3>
              </div>
              <meta http-equiv="refresh" content="3">'; 
        }

        else {
            echo '<div class="alert alert-danger text-center" role="alert">
        <h3>Data was not successfully saved !</h3>
              </div>
              <meta http-equiv="refresh" content="5">';
        }

    }
}

function update_working_day () {
    global $wpdb;
    $table = $wpdb->prefix . "working_hours_pg";

    if (isset($_POST['end_working_day_btn'])) {
       $update_current_date_id = $_POST['update_ending_time'];
        $update_ending_time =  $_POST['end_time'];

        $results = $wpdb->query("UPDATE $table SET end_time = '$update_ending_time' WHERE id='$update_current_date_id'");
        
        if ($results) {


            $results_times = $wpdb->get_results("Select start_time, end_time from $table where id ='$update_current_date_id'");
            if ($results_times){
                foreach ($results_times as $row){

                    $starting_time = strtotime($row->start_time);
                    $ending_time = strtotime($row->end_time);
                    $total_time = ((int)$ending_time-(int)$starting_time);
                  
                    $total_time_difference =   gmdate("H:i:s", $total_time);
                  
                    $results_times = $wpdb->query("UPDATE $table SET total_time = '$total_time_difference' WHERE id='$update_current_date_id'");
                   
            }
            }


            echo '<div class="alert alert-success text-center" role="alert">
        <h3>Data Saved successfully !</h3>
              </div>
              <meta http-equiv="refresh" content="2"> ';       
        }
        //
        else {
            echo '<div class="alert alert-danger text-center" role="alert">
        <h3>Data was not successfully saved !</h3>
              </div>
              <meta http-equiv="refresh" content="5">';
        }

    }
}


function update_working_day_as_admin () {
    global $wpdb;
    $table = $wpdb->prefix . "working_hours_pg";

    if (isset($_POST['updatedata'])) {

       $update_current_date_id = $_POST['update_id'];
       $update_date = $_POST['date_selected'];
       $update_starting_time = $_POST['starting_time'];
       $update_ending_time = $_POST['ending_time'];

       
        $total_time = (strtotime ($update_ending_time) - strtotime($update_starting_time));

        $update_total_time = gmdate("H:i:s",$total_time);
        $results = $wpdb->query("UPDATE $table SET workday_date='$update_date', start_time='$update_starting_time', end_time = '$update_ending_time', total_time = '$update_total_time' WHERE id='$update_current_date_id'");
        
        if ($results) {

            echo '<div class="alert alert-success text-center" role="alert">
        <h3>Data Saved successfully !</h3>
              </div>
              <meta http-equiv="refresh" content="2">';            
        }

        else {
            echo '<div class="alert alert-danger text-center" role="alert">
        <h3>Data was not successfully saved !</h3>
              </div>
              <meta http-equiv="refresh" content="5">';
        }

    }
}


